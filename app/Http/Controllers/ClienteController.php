<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteEureka;
use App\Models\EstadoCliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $estados = $this->obtenerEstados();
        $clientes = $this->obtenerClientes();
        return view('cliente.index', compact('clientes', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = $this->obtenerEstados();
        return view('cliente.create', compact('estados'));
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
            'identidad' => 'required|string|size:13|unique:clientes_eureka,identidad',
            'nombre' => 'required|string',
            'email' => 'required|string|email|unique:clientes_eureka,email',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'referencia' => 'required|string',
            'numero_talonario' => 'required|string|size:7',
            'id_estado_cliente' => 'required|exists:estados_cliente,id_estado_cliente'
        ], [
            'identidad.size' => 'El campo identidad debe tener 13 caracteres',
            'identidad.unique' => 'La identidad ya existe en la base de datos',
            'numero_talonario.size' => 'El campo numero de talonario debe tener 7 caracteres',
            'email.email' => 'El campo email debe ser un email valido',
            'email.unique' => 'El email ya esta registrado para otro cliente',
        ]);
        try {
            ClienteEureka::create($data);
            return redirect()->route('cliente.index')->with('success', 'Cliente creado correctamente');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear el ciente');
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
    public function edit(ClienteEureka $cliente)
    {
        //
        $estados = $this->obtenerEstados();
        return view('cliente.edit', compact('cliente', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteEureka $cliente)
    {
        //
        $data = $request->validate([
            'identidad' => 'required|string|size:13',
            'nombre' => 'required|string',
            'email' => 'required|string|email',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'referencia' => 'required|string',
            'numero_talonario' => 'required|size:7',
            'id_estado_cliente' => 'required|exists:estados_cliente,id_estado_cliente'
        ], [
            'identidad.size' => 'El campo identidad debe tener 13 caracteres y ser unico',
            'identidad.unique' => 'La identidad ya existe en la base de datos',
            'telefono.numeric' => 'El campo teléfono debe ser numérico',
            'numero_talonario.size' => 'El campo numero de talonario debe tener 7 caracteres',
            'email.email' => 'El campo email debe ser un email valido',
        ]);
        try {
            $cliente->update($data);
            return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el ciente');
        }
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
     * Funcion para mostrar los clientes
     */
    public function obtenerClientes()
    {
        $clientes = ClienteEureka::with('estado')->get();
        return $clientes;
    }

    public function obtenerEstados()
    {
        $estados = EstadoCliente::all();
        return $estados;
    }
}
