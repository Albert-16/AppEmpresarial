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

        //estados de las actividades
        const ESTADO_ACTIVIDAD_COMPLETADA = 1;
        const ESTADO_ACTIVIDAD_EN_PROCESO = 2;
        const ESTADO_ACTIVIDAD_CANCELADA = 3;
        
        //empresas
        const EMPRESA_EUREKA = 1;
        const EMPRESA_ZMEDIA = 2;
        const EMPRESA_VACA = 3;
        const EMPRESA_CEA = 4;

        const CORREO_CARLOS = 'carlosardon001@gmail.com';
        const CORREO_JUAN = 'albertdev7528@gmail.com';
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
            'nombre_actividad' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/|max:50',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date|after_or_equal:fecha_inicio',
            'costo' => 'required|numeric',
            'egresos' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa'
        ], [
            'nombre_actividad.regex' => 'El nombre de la actividad solo puede contener letras y espacios',
            'nombre_actividad.max' => 'El nombre de la actividad no puede contener más de 50 caracteres',
            'descripcion.max' => 'La descripción no puede contener más de 255 caracteres',
            'costo.numeric' => 'El costo debe ser un número',
            'egresos.numeric' => 'Los egresos deben ser un número',
            'fecha_finalizacion.after_or_equal' => 'La fecha de finalización debe ser mayor o igual a la fecha de inicio'
        ]	);
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
            'nombre_actividad' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/|max:50',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date|after_or_equal:fecha_inicio',
            'costo' => 'required|numeric',
            'egresos' => 'required|numeric',
            'id_estado' => 'required|exists:estados,id_estado',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_empresa' => 'required|exists:empresas,id_empresa'
        ], [
            'nombre_actividad.regex' => 'El nombre de la actividad solo puede contener letras y espacios',
            'nombre_actividad.max' => 'El nombre de la actividad no puede contener más de 50 caracteres',
            'descripcion.max' => 'La descripción no puede contener más de 255 caracteres',
            'costo.numeric' => 'El costo debe ser un número',
            'egresos.numeric' => 'Los egresos deben ser un número',
            'fecha_finalizacion.after_or_equal' => 'La fecha de finalización debe ser mayor o igual a la fecha de inicio'
        ]	);
        try {
            $total = $data['costo'] - $data['egresos'];
            $data['total'] = $total;
            $actividad->update($data);
            $actividad->actividadesEmpresa()->sync($request->input('id_empresa'));
            $actividad->actividadesEncargado()->sync($request->input('id_encargado'));
            // enviar correo electrónico
            Mail::to('carlosardon001@gmail.com')->send(new CorreoElectronico(
                $data['nombre_actividad'],
                $data['fecha_inicio'],
                $data['fecha_finalizacion'],
                $data['descripcion'],
                $data['costo']
            ));
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
