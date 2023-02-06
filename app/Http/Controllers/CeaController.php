<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class CeaController extends Controller
{
    //estados
    const ESTADO_ACTIVIDAD_COMPLETADA = 1;
    const ESTADO_ACTIVIDAD_EN_PROCESO = 2;
    const ESTADO_ACTIVIDAD_CANCELADA = 3;
    //empresas
    const EMPRESA_EUREKA = 1;
    const EMPRESA_ZMEDIA = 2;
    const EMPRESA_VACA = 3;
    const EMPRESA_CEA = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
             //traer todas las actividades por su estado
        $actividadesCompletadas = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_COMPLETADA);
        $actividadesProceso = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_EN_PROCESO);
        $actividadesCanceladas = $this->obtenerConteoActividades(self::ESTADO_ACTIVIDAD_CANCELADA);

            //
        $datosGanancias = $this->obtenerDatosGanancias();

        //-------------------Tablas---------------------
        $tableActividadesCompletadas = $this->actividadesCompletadas();
        $tableActividadesProceso = $this->actividadesPendientes();
        $tableActividadesCanceladas = $this->actividadesCanceladas();
        return view('cea.index', compact(
            'datosGanancias',
            'tableActividadesCompletadas',
            'tableActividadesProceso',
            'tableActividadesCanceladas',
            'actividadesCompletadas',
            'actividadesProceso',
            'actividadesCanceladas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     /**
      * Funcion que retorna las ganancias
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
     * Funcion que retorna las actividades completadas y empresa especifica
     */
   private function actividadesCompletadas()
    {
        $actividades = Actividad::with('encargado', 'empresa', 'estado')
        ->where('id_estado', SELF::ESTADO_ACTIVIDAD_COMPLETADA)
        ->where('id_empresa', SELF::EMPRESA_CEA)
        ->get();
        return $actividades;
    }
    /**
     * Funcion que retorna las actividades en proceso
     */
   private function actividadesPendientes()
    {
        $actividades = Actividad::with('encargado', 'empresa', 'estado')
            ->where('id_estado', SELF::ESTADO_ACTIVIDAD_EN_PROCESO)
            ->where('id_empresa', SELF::EMPRESA_CEA)
            ->get();
        return $actividades;
    }
    /**
     * Funcion que retorna las actividades canceladas
     */
    function actividadesCanceladas()
    {
        $actividades = Actividad::with('encargado', 'empresa', 'estado')
            ->where('id_estado', SELF::ESTADO_ACTIVIDAD_CANCELADA)
            ->where('id_empresa', SELF::EMPRESA_CEA)
            ->get();
        return $actividades;
    }
    /**
     * Funcion que retorna el conteo de actividades por estado
     */
    private function obtenerConteoActividades(int $idEstado)
    {
        return Actividad::where('id_estado', $idEstado)
        ->where('id_empresa', SELF::EMPRESA_CEA)
        ->count();
    }

}
