<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ConciertoRepository;
use App\Models\Concierto;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ConciertoController
 * @package App\Http\Controllers\Api
 */
class ConciertoController extends Controller
{
    /**
     * Alta de concierto y envío de mail de información
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function altaConcierto(Request $request)
    {
        //Validamos los datos que nos llegan
        //Podríamos hacer la validación a traves de un objeto Request validation, pero está forma es más facil de debug
        $request->validate([
            'nombre' => 'required|string|max:80',
            'fecha' => 'required|date',
            'recinto_id' => 'required|exists:recintos,id',
            'numero_espectadores' => 'required|integer',
            'promotor_id' => 'required|exists:promotores,id',
            'grupos_ids' => 'required|array',
            'grupos_ids.*' => 'required|exists:grupos.id',
            'medios_publicitarios_ids' => 'required|array',
            'medios_publicitarios_ids.*' => 'required|exists:medios.id',
        ]);

        try {
            //Iniciamos una transaccion db
            \DB::beginTransaction();

            //Damos de alta el concierto
            $concierto_repository = new ConciertoRepository();
            $concierto = $concierto_repository->altaConcierto(
                $request->nombre,
                $request->promotor_id,
                $request->recinto_id,
                $request->numero_espectadores,
                $request->fecha,
                $request->grupos_ids,
                $request->medios_publicitarios_ids
            );

            //Cargamos en el objeto de Concierto las relations para no machacar la DB después en futuros bucles
            $concierto->load('recinto');
            $concierto->load('promotor');
            $concierto->load('grupos');
            $concierto->load('medios');

            //Obtenemos el desglose del concierto
            $desglose = $concierto_repository->obtenerDesgloseConcierto($concierto);

            //Updateamos la rentabilidad del concierto
            $concierto_repository->updateRentabilidadConcierto($concierto, $desglose);

            //Enviamos el mail
            $concierto_repository->enviarMailPromotor($concierto, $desglose);

            //La operación ha sido correcta y hacemos un commit a db
            \DB::commit();

            return $this->customResponse(true, 'Alta de concierto correcta.');
        } catch (\Exception $ex) {
            //Ha habido una exception y hacemos un rollback db
            \DB::rollback();

            //Logueamos el error
            \Log::error('Error en el alta de un concierto', ['request' => $request->all(), 'exception' => $ex]);

            return $this->customResponse(false, 'Ha ocurrido un error durante el alta de concierto.', 400, 'Exception en alta de concierto.');
        }
    }

    /**
     * Respuesta custom para api
     *
     * @param bool $status
     * @param array $msg
     * @param int $status_code
     * @param string $dev_msg
     * @return \Illuminate\Http\JsonResponse
     */
    private function customResponse($status = true, $msg = [], $status_code = 200, $dev_msg = '') {
        //Formamos el array genérico
        $data = [
            'status' => $status ? 'success' : 'error',
            'msg' => $msg,
            'dev_msg' => $dev_msg
        ];

        return response()->json($data, $status_code);
    }
}
