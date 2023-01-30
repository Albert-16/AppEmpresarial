<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Encargado;

class HomeController extends Controller
{
    //
    const ESTADO_ACTIVIDAD_COMPLETADA = 3;
    const ESTADO_ACTIVIDAD_EN_PROCESO = 4;
    const ESTADO_ACTIVIDAD_CANCELADA = 5;
    public function index()
    {
        //traer el total de actividades
        $totalActividades = $this->obtenerTotalActividades();

        //traer todas las actividades por su estado
        $actividadesCompletadas = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_COMPLETADA);
        $actividadesProceso = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_EN_PROCESO);
        $actividadesCanceladas = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_CANCELADA);

        //traer el total de encargados
        $totalEncargados = $this->obtenerTotalEncargados();

        //traer el total de ganancias formateado
        $datosGanancias = $this->obtenerDatosGanancias();

        //traer el nombre de la actividad con mayor ingreso
        $actividadMayorIngreso = $this->mayorIngreso();

        //traer el mes con mayor ingreso
        $actividadMayorIngresoMes = $this->mayorIngresoMes();

        return view('home.index', compact(
            'actividadesCanceladas',
            'actividadesCompletadas',
            'actividadesProceso',
            'totalEncargados',
            'datosGanancias',
            'totalActividades',
            'actividadMayorIngreso',
            'actividadMayorIngresoMes'
        ));
    }
/**
 * Obtener el total de actividades por estado
 *
 * @param integer $idEstado
 * @return void
 */
    private function obtenerConteoActividades(int $idEstado)
    {
        return Actividad::where('id_estado', $idEstado)->count();
    }

    private function obtenerTotalEncargados()
    {
        return Encargado::count();
    }
/**
 * Obtener el total de ganancias
 *
 * @return void
 */
    private function obtenerDatosGanancias()
    {
        $ganancias = Actividad::sum('costo');
        $gananciasFormateadas = number_format($ganancias, 2, ".", ",");
        $moneda = "L ";
        $datosGanancias = [
            'moneda' => $moneda,
            'ganancias' => $ganancias,
            'gananciasFormateadas' => $gananciasFormateadas
        ];
        return $datosGanancias;
    }

    /**
     * Obtener el total de actividades
     *
     * @return void
     */
    private function obtenerTotalActividades()
    {
        return Actividad::count();
    }
/**
 * Obtener el nombre de la actividad con mayor ingreso
 *
 * @return void
 */
    public function mayorIngreso()
    {
        $actividades = Actividad::selectRaw('nombre_actividad, SUM(costo) as costo')
            ->groupBy('nombre_actividad')
            ->orderBy('costo', 'desc')
            ->limit(1)
            ->get();
        return $actividades;
    }
   /**
    * Obtener el mes con mayor ingreso el nombre del mes en español
    *
    * @return void
    */
    public function mayorIngresoMes()
    {
        $actividades = Actividad::selectRaw('MONTHNAME(fecha_inicio) as mes, SUM(costo) as costo')
            ->groupBy('mes')
            ->orderBy('costo', 'desc')
            ->limit(1)
            ->get();
        return $actividades;
    }

}
