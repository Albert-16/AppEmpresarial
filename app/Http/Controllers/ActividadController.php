<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Models\Empresa;
use App\Models\Estado_Encargado;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $actividades = Actividad::with('estado', 'encargado', 'empresa')->get();
        //dd($actividades);
        $estados = Estado::all();
        return view('actividad.index', compact('actividades', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estadoActivo = Estado_Encargado::where('descripcion', 'Activo')->first();
        $encargadosActivos = Encargado::where('id_estado_encargado', $estadoActivo->id_estado_encargado)->get();
        $estados = Estado::all();
        $empresas = Empresa::all();
        return view('actividad.create', compact('estados','empresas', 'encargadosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_actividad' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'costo' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa'

        ]);

        try {
            $actividad = Actividad::create($data);
            $actividad->actividadesEncargado()->sync([$request->id_encargado]);
            $actividad->actividadesEmpresa()->sync([$request->id_empresa]);
            return redirect()->route('actividad.index')->with('success', 'Actividad creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la actividad.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show(Actividad $actividad)
    {
        //
        $actividad->load('estado');
        return view('actividad.show', compact('actividad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
        $estados = Estado::all();
        $encargados = Encargado::all();
        $empresas = Empresa::all();
        return view('actividad.edit', compact('actividad', 'estados', 'encargados', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        $data = $request->validate([
            'nombre_actividad' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'costo' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa',
        ]);
        try {
            $actividad->update($data);
            $actividad->actividadesEmpresa()->sync($request->input('id_empresa'));
            $actividad->actividadesEncargado()->sync($request->input('id_encargado'));
            return redirect()->route('actividad.index')->with('success', 'Actividad actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la actividad.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        //
    }
}
