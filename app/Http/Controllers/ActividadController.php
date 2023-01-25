<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\Encargado;

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
        $actividades = Actividad::with('estado')->get();
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
        $estados = Estado::all();
        $encargados = Encargado::all();
        return view('actividad.create', compact('estados','encargados'));
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
            'id_encargado' => 'required|exists:encargados,id_encargado'
        ]);

        try {
            $actividad = Actividad::create($data);
            $actividad->actividadesEncargado()->sync([$request->id_encargado]);
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
        return view('actividad.edit', compact('actividad', 'estados'));
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
            'id_estado' => 'required|exists:estados,id_estado'
        ]);

        $actividad->update($data);
        return redirect()->route('actividad.index')->with('success', 'Actividad actualizada con éxito');
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
