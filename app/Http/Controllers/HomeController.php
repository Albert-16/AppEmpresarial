<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Encargado;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

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


        //-------------------GRAFICAS---------------------
        //traer el total de ingresos por mes
        $ingresoMeses = $this->obtenerCostoPorMeses();

        //agrupar por mes
        $datosAgrupados = $this->agruparPorMes($ingresoMeses);

        //obtener actividades por mes
        $actividadesMensuales = $this->actividadesPorMes();

        //agrupar actividades por mes
        $actividadesAgrupadas = $this->agruparActividadesPorMes($actividadesMensuales);
       

        return view('home.index', compact(
            'actividadesCanceladas',
            'actividadesCompletadas',
            'actividadesProceso',
            'totalEncargados',
            'datosGanancias',
            'totalActividades',
            'actividadMayorIngreso',
            'actividadMayorIngresoMes',
            'datosAgrupados',
            'actividadesAgrupadas'
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

    /**
     * obtener el total de ingresos por mes
     */

    function obtenerCostoPorMeses()
    {
        $resultados = DB::table('actividades')
            ->select(
                DB::raw('DATE_FORMAT(fecha_inicio, "%M") as mes'),
                DB::raw('SUM(costo) as costo')
            )
            ->groupBy(DB::raw('MONTH(fecha_inicio)'), 'fecha_inicio')
            ->orderBy(DB::raw('MONTH(fecha_inicio)'), 'asc')
            ->get();

        $mes = [];
        $costo = [];
        foreach ($resultados as $resultado) {
            $mes[] = $resultado->mes;
            $costo[] = $resultado->costo;
        }
        return [
            'mes' => $mes,
            'costo' => $costo
        ];
    }
    /**
     * Agrupar por mes
     *
     * @param [type] $datos
     * 
     */
    function agruparPorMes($datos)
    {
        $resultados = [];
        foreach ($datos['mes'] as $key => $mes) {
            if (array_key_exists($mes, $resultados)) {
                $resultados[$mes] += $datos['costo'][$key];
            } else {
                $resultados[$mes] = $datos['costo'][$key];
            }
        }
        return $resultados;
    }

    /**
     * Obtener actividades por mes
     *
     * 
     */
    function actividadesPorMes()
    {
        $resultados = DB::table('actividades')
            ->select(
                DB::raw('COUNT(id_actividad) as cantidad'),
                DB::raw('DATE_FORMAT(fecha_inicio, "%M") as mes')

            )
            ->groupBy(DB::raw('MONTH(fecha_inicio)'), 'fecha_inicio')
            ->orderBy(DB::raw('MONTH(fecha_inicio)'), 'asc')
            ->get();

        $mes = [];
        $cantidad = [];
        foreach ($resultados as $resultado) {
            $mes[] = $resultado->mes;
            $cantidad[] = $resultado->cantidad;
        }
        return [
            'cantidad' => $cantidad,
            'mes' => $mes
        ];
    }

    /**
     * Agrupar por mes
     *
     * @param [type] $datos
     * 
     */
    function agruparActividadesPorMes($datos)
    {
        $resultados = [];
        foreach ($datos['mes'] as $key => $mes) {
            if (array_key_exists($mes, $resultados)) {
                $resultados[$mes] += $datos['cantidad'][$key];
            } else {
                $resultados[$mes] = $datos['cantidad'][$key];
            }
        }
        return $resultados;
    }
}
