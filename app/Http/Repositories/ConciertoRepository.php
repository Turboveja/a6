<?php

namespace App\Http\Repositories;

use App\Http\Classes\DesgloseConcierto;
use App\Mail\EnviarMailDesgloseConciertoPromotor;

/**
 * Class ConciertoRepository
 * @package App\Http\Repositories
 */
class ConciertoRepository
{
    /**
     * @param $nombre
     * @param $promotor_id
     * @param $recinto_id
     * @param int $numero_espectadores
     * @param $fecha
     * @param $grupos
     * @param $medios
     * @return mixed
     */
    public function altaConcierto($nombre, $promotor_id, $recinto_id, $numero_espectadores = 0, $fecha, $grupos, $medios)
    {
        //Creamos el concierto
        $concierto = Concierto::create([
            'id_promotor' => $promotor_id,
            'id_recinto' => $recinto_id,
            'nombre' => $nombre,
            'numero_espectadores' => $numero_espectadores,
            'fecha' => $fecha,
//            'rentabilidad' => $rentabilidad, //La updateamos a futuro por si se quieren crear conciertos antes de que se celebren
        ]);

        //Añadimos los grupos al concierto
        $concierto->grupos()->attach($grupos);

        //Añadimos los medios publicitarios al concierto
        $concierto->mediosPublicitarios()->attach($medios);

        return $concierto;
    }

    /**
     * Hacemos update de la rentabilidad de un concierto en base a sus datos
     *
     * @param Concierto $concierto
     * @return bool
     */
    public function updateRentabilidadConcierto(Concierto $concierto, Desglose $desglose)
    {
        $desglose_concierto = $this->obtenerDesgloseConcierto($concierto);

        $update = $concierto->update([
            'rentabilidad' => $desglose_concierto['rentabilidad']
        ]);

        return $update;
    }

    public function enviarMailPromotor(Concierto $concierto = null, DesgloseConcierto $desglose, $mail_promotor)
    {
        //Enviamos el mail al promotor
        \Mail::to($mail_promotor)->send(new EnviarMailDesgloseConciertoPromotor($concierto, $desglose));

        //TODO enviamos el mail
    }

    /**
     * Devolvemos el desglose entero de un concierto
     *
     * @param $concierto
     * @return Desglose
     */
    public function obtenerDesgloseConcierto($concierto)
    {
        #region Entradas de dinero
        //Precio de cada entrada
        $precio_entrada = $concierto->recinto->precio_entrada;

        //Total de dinero entrante
        $total_entradas_plano = $precio_entrada * $concierto->numero_espectadores;
        #endregion

        #region Salidas de dinero
        //Coste de alquiler
        $alquiler_recinto = $concierto->recinto->coste_alquiler;

        //Cache de los grupos y 10% de cache grupos por entrada
        $porcentaje_fijo = 10;
        $cache_grupos = 0;
        $porcentaje_entradas = 0; //Porcentaje de cada entrada
        foreach($concierto->grupos as $grupo){
            $cache_grupos += $grupo->cache;
            $porcentaje_entradas += (($porcentaje_fijo/100)*$total_entradas_plano);
        }
        #endregion

        #region Totales
        //Totales
        $total_entrante = $total_entradas_plano - $porcentaje_entradas;
        $total_saliente = $cache_grupos + $alquiler_recinto + $porcentaje_entradas;

        //Obtenemos el total
        $rentabilidad = $total_entrante - $total_saliente;
        #endregion

        //TODO podríamos tener los totales y caches de cada grupo en un array con su nombre y cantidad
        //Generamos el desglose
        $desglose = new Desglose($precio_entrada,
            $total_entradas_plano,
            $alquiler_recinto,
            $porcentaje_fijo,
            $cache_grupos,
            $porcentaje_entradas,
            $total_entrante,
            $total_saliente,
            $rentabilidad
        );

        return $desglose;
    }
}
