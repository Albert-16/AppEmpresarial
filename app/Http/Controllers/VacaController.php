<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class VacaController extends Controller
{
    const ESTADO_ACTIVIDAD_COMPLETADA = 1;
    const ESTADO_ACTIVIDAD_EN_PROCESO = 2;
    const ESTADO_ACTIVIDAD_CANCELADA = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('vaca.index', compact(
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

    //funciones 

    /**
     * Funcion que retorna las actividades completadas
     * 
     */
    function actividadesCompletadas()
    {
        $actividades = Actividad::with('encargado', 'empresa', 'estado')
            ->where('id_estado', SELF::ESTADO_ACTIVIDAD_COMPLETADA)
            ->get();
        return $actividades;
    }
    /**
     * Funcion que retorna las actividades en proceso
     */
    function actividadesPendientes()
    {
        $actividades = Actividad::with('encargado', 'empresa', 'estado')
            ->where('id_estado', SELF::ESTADO_ACTIVIDAD_EN_PROCESO)
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
            ->get();
        return $actividades;
    }
}
