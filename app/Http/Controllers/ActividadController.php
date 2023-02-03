<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Models\Empresa;
use App\Models\Estado_Encargado;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoElectronico;
use Illuminate\Support\Facades\Log;




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
        $estados = $this->obtenerEstados();
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
        $encargadosActivos = $this->encargadosActivos();
        $estados = $this->obtenerEstados();
        $empresas = $this->obtenerEmpresas();
        return view('actividad.create', compact('estados', 'empresas', 'encargadosActivos'));
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
            'egresos' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa'
        ]);
        try {
            $total = $data['costo'] - $data['egresos'];
            $data['total'] = $total;
            $actividad = Actividad::create($data);
            $actividad->actividadesEncargado()->sync([$request->id_encargado]);
            $actividad->actividadesEmpresa()->sync([$request->id_empresa]);
            // enviar correo electrónico
            Mail::to('carlosardon001@gmail.com')->send(new CorreoElectronico(
                $data['nombre_actividad'],
                $data['fecha_inicio'],
                $data['fecha_finalizacion'],
                $data['descripcion'],
                $data['costo']
            ));
            return redirect()->route('actividad.index')->with('success', 'Actividad creada exitosamente.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
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
        $estados = $this->obtenerEstados();
        $encargados = $this->obtenerEncargados();
        $empresas = $this->obtenerEmpresas();
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
            'egresos' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa',
        ]);
        try {
            $total = $data['costo'] - $data['egresos'];
            $data['total'] = $total;
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
    //Funcion para obtener los encargados activos
    public function encargadosActivos()
    {
        $estadoActivo = Estado_Encargado::where('descripcion', 'Activo')->first();
        $encargadosActivos = Encargado::where('id_estado_encargado', $estadoActivo->id_estado_encargado)->get();
        return $encargadosActivos;
    }

    //funcion para obtener las empresas
    public function obtenerEmpresas()
    {
        $empresas = Empresa::all();
        return $empresas;
    }

    //funcion para obtener los estados
    public function obtenerEstados()
    {
        $estados = Estado::all();
        return $estados;
    }

    //funcion para obtener los encargados
    public function obtenerEncargados()
    {
        $encargados = Encargado::all();
        return $encargados;
    }
}
