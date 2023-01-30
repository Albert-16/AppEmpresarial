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

        return view('home.index', compact(
            'actividadesCanceladas',
            'actividadesCompletadas',
            'actividadesProceso',
            'totalEncargados',
            'datosGanancias',
            'totalActividades'
        ));
    }

    private function obtenerConteoActividades(int $idEstado)
    {
        return Actividad::where('id_estado', $idEstado)->count();
    }

    private function obtenerTotalEncargados()
    {
        return Encargado::count();
    }

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

    private function obtenerTotalActividades()
    {
        return Actividad::count();
    }
}
