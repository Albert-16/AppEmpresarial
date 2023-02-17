<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use App\Models\Estado_Encargado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EncargadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $encargados = Encargado::with('estadoEncargado')->get();
        $estados = Estado_Encargado::all();
        return view('encargado.index', compact('encargados', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = Estado_Encargado::all();
        return view('encargado.create', compact('estados'));
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
        $data = $request->validate([
            'nombre_encargado' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                'unique:encargados,email'
            ],
            'id_estado_encargado' => 'required|exists:estado_encargados,id_estado_encargado'
        ], [
            'nombre_encargado.required' => 'El nombre del encargado es requerido.',
            'nombre_encargado.string' => 'El nombre del encargado debe ser una cadena de texto.',
            'telefono.required' => 'El teléfono del encargado es requerido.',
            'telefono.string' => 'El teléfono del encargado debe ser una cadena de texto.',
            'direccion.required' => 'La dirección del encargado es requerida.',
            'direccion.string' => 'La dirección del encargado debe ser una cadena de texto.',
            'email.required' => 'El correo electrónico del encargado es requerido.',
            'id_estado_encargado.required' => 'El estado del encargado es requerido.',
            'id_estado_encargado.exists' => 'El estado del encargado no existe.',
            'email.unique' => 'El correo electrónico del encargado ya esta registrado a otro encargado.'
        ]);
        try {
            Encargado::create($data);
            return redirect()->route('encargado.index')->with('success', 'Encargado creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear el encargado.');
        }
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
    public function edit(Encargado $encargado)
    {
        //
        $estados = Estado_Encargado::all();
        //dd($estados);
        return view('encargado.edit', compact('estados', 'encargado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encargado $encargado)
    {
        //
        $data = $request->validate([
            'nombre_encargado' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('encargados')->ignore($encargado->email, 'email')
            ],
            'id_estado_encargado' => 'required|exists:estado_encargados,id_estado_encargado'
        ], [
            'nombre_encargado.required' => 'El nombre del encargado es requerido.',
            'nombre_encargado.string' => 'El nombre del encargado debe ser una cadena de texto.',
            'telefono.required' => 'El teléfono del encargado es requerido.',
            'telefono.string' => 'El teléfono del encargado debe ser una cadena de texto.',
            'direccion.required' => 'La dirección del encargado es requerida.',
            'direccion.string' => 'La dirección del encargado debe ser una cadena de texto.',
            'email.required' => 'El correo electrónico del encargado es requerido.',
            'id_estado_encargado.required' => 'El estado del encargado es requerido.',
            'id_estado_encargado.exists' => 'El estado del encargado no existe.',
            'email.unique' => 'El correo electrónico del encargado ya esta registrado a otro encargado.'
        ]);

        try {
            $encargado->update($data);
            return redirect()->route('encargado.index')->with('success', 'Encargado modificado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al modificar el encargado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_encargado)
    {
        //
        $data = $request->validate([
            'id_estado_encargado' => 'required|exists:estado_encargados,id_estado_encargado'
        ]);

        try {
            $id_encargado->update($data);
            return redirect()->route('encargado.index')->with('success', 'Encargado modificado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al modificar el encargado.');
        }
    }
}
