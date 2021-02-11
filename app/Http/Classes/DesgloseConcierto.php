<?php


namespace App\Http\Classes;

/**
 * Class DesgloseConcierto
 * @package App\Http\Classes
 */
class DesgloseConcierto
{
        public $precio_entrada,
                $total_entradas_plano,
                $alquiler_recinto,
                $porcentaje_fijo,
                $cache_grupos,
                $porcentaje_entradas,
                $total_entrante,
                $total_saliente,
                $rentabilidad;

    /**
     * DesgloseConcierto constructor.
     *
     * @param $precio_entrada
     * @param $total_entradas_plano
     * @param $alquiler_recinto
     * @param $porcentaje_fijo
     * @param $cache_grupos
     * @param $porcentaje_entradas
     * @param $total_entrante
     * @param $total_saliente
     * @param $rentabilidad
     */
    public function __construct($precio_entrada, $total_entradas_plano, $alquiler_recinto, $porcentaje_fijo, $cache_grupos, $porcentaje_entradas, $total_entrante, $total_saliente, $rentabilidad)
    {
        $this->precio_entrada = $precio_entrada;
        $this->total_entradas_plano = $total_entradas_plano;
        $this->alquiler_recinto = $alquiler_recinto;
        $this->porcentaje_fijo = $porcentaje_fijo;
        $this->cache_grupos = $cache_grupos;
        $this->porcentaje_entradas = $porcentaje_entradas;
        $this->total_entrante = $total_entrante;
        $this->total_saliente = $total_saliente;
        $this->rentabilidad = $rentabilidad;
    }

    /**
     * @return mixed
     */
    public function getPrecioEntrada()
    {
        return $this->precio_entrada;
    }

    /**
     * @return mixed
     */
    public function getTotalEntradasPlano()
    {
        return $this->total_entradas_plano;
    }

    /**
     * @return mixed
     */
    public function getAlquilerRecinto()
    {
        return $this->alquiler_recinto;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeFijo()
    {
        return $this->porcentaje_fijo;
    }

    /**
     * @return mixed
     */
    public function getCacheGrupos()
    {
        return $this->cache_grupos;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeEntradas()
    {
        return $this->porcentaje_entradas;
    }

    /**
     * @return mixed
     */
    public function getTotalEntrante()
    {
        return $this->total_entrante;
    }

    /**
     * @return mixed
     */
    public function getTotalSaliente()
    {
        return $this->total_saliente;
    }

    /**
     * @return mixed
     */
    public function getRentabilidad()
    {
        return $this->rentabilidad;
    }




}
