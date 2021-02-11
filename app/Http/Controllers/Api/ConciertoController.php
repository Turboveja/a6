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

    public function altaConcierto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:80',
            'fecha' => 'required|date',
            'recinto_id' => 'required|exists:recintos,id',
            'numero_espectadores' => 'required|integer',
            'promotor_id' => 'required|exists:promotores,id',
            'grupos_ids' => 'required|array',
            'grupos_ids.*' => 'required|exists:grupos.id',
            'medios_publicitarios_ids' => 'required|array',
            'medios_publicitarios_ids.*' => 'required|exists:medios_publicitarios.id',
        ]);

        try {
            \DB::beginTransaction();

            //promotores
            //recintos
            //conciertos
            //grupos
            //medios (publicidad)
            //grupos_conciertos
            //grupos_medios

            $rentabilidad = null; //TODO luego la calculamos

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

            //todo hacer update del desglose

            //Enviamos un mail al promotor del concierto
            $email_promotor = $concierto->promotor->email;
//            $promotor = Promotor::find($request->promotor);

            //Enviamos el mail
            $mail_concierto = $concierto_repository->enviarMailPromotor($concierto, $desglose, $email_promotor);

            \DB::commit();

            //TODO podríamos hacer un método response generico para success o error, sería algo parecido a esta respuesta
            return response()->json([
                'status' => 'success',
                'msg' => 'Alta de concierto correcta',
                'dev_msg' => '', //Mensaje para debug, si fuera necesario
            ], 200);
        } catch (\Exception $ex) {
            \DB::rollback();
            \Log::error('Error en el alta de un concierto', ['request' => $request->all(), 'exception' => $ex]);

            //TODO podríamos hacer un método response generico para success o error, sería algo parecido a esta respuesta
            return response()->json([
                    'status' => 'error',
                    'msg' => 'Ha ocurrido un error durante el alta de concierto.',
                    'dev_msg' => '', //Mensaje para debug, si fuera necesario
                ], 400);
        }
    }
}
