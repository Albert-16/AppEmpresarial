<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteEureka;
use App\Models\EstadoCliente;
use Illuminate\Validation\Rule;


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
            'identidad' => [
                'required',
                'string',
                'size:13',
                'unique:clientes_eureka,identidad',
                'regex:/^(0[1-9]|1[0-8])(0[1-9]|[12]\d|3[01])\d{4}\d{5}$/',
                function ($attribute, $value, $fail) {
                    $dob = new \DateTime(request('fecha_nacimiento'));
                    $now = new \DateTime();
                    $age = $now->diff($dob)->y;
        
                    if ($age < 18) {
                        $fail('La persona debe ser mayor de edad.');
                    }
        
                    $year = substr($value, 4, 4);
        
                    if ($dob->format('Y') != $year) {
                        $fail('El año de la fecha de nacimiento no coincide con los valores proporcionados en la identidad.');
                    }
                },
            ],
            'nombre' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'email' => 'required|string|email|unique:clientes_eureka,email',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $dob = new \DateTime($value);
                    $now = new \DateTime();
                    $age = $now->diff($dob)->y;
                    if ($age < 18) {
                        $fail('La persona debe ser mayor de edad.');
                    }
                },
            ],
            'referencia' => 'required|string',
            'numero_talonario' => 'required|string|size:7',
            'id_estado_cliente' => 'required|exists:estados_cliente,id_estado_cliente'
        ], [
            'identidad.size' => 'El campo identidad debe tener 13 caracteres',
            'nombre.regex' => 'El campo nombre solo debe contener letras y espacios',
            'nombre.max' => 'El campo nombre no debe contener más de 100 caracteres',
            'identidad.unique' => 'La identidad ya existe en la base de datos',
            'numero_talonario.size' => 'El campo numero de talonario debe tener 7 caracteres',
            'email.email' => 'El campo email debe ser un email valido',
            'email.unique' => 'El email ya esta registrado para otro cliente',
            'fecha_nacimiento' => 'La fecha de nacimiento debe ser mayor a 18 años',
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
            'identidad' => [
                'required',
                'string',
                'size:13',
                'regex:/^(0[1-9]|1[0-8])(0[1-9]|[12]\d|3[01])\d{4}\d{5}$/',
                function ($attribute, $value, $fail) {
                    $dob = new \DateTime(request('fecha_nacimiento'));
                    $now = new \DateTime();
                    $age = $now->diff($dob)->y;

                    if ($age < 18) {
                        $fail('La persona debe ser mayor de edad.');
                    }

                    $year = substr($value, 4, 4);

                    if ($dob->format('Y') != $year) {
                        $fail('El año de la fecha de nacimiento no coincide con los valores proporcionados en la identidad.');
                    }
                },
            ],
            'nombre' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/|max:100',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('clientes_eureka')->ignore($cliente->email, 'email')
            ],
            
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $dob = new \DateTime($value);
                    $now = new \DateTime();
                    $age = $now->diff($dob)->y;
                    if ($age < 18) {
                        $fail('La persona debe ser mayor de edad.');
                    }
                },
            ],
            'referencia' => 'required|string',
            'numero_talonario' => 'required|string|size:7',
            'id_estado_cliente' => 'required|exists:estados_cliente,id_estado_cliente'
        ], [
            'identidad.size' => 'El campo identidad debe tener 13 caracteres',
            'identidad.regex' => 'El campo identidad no es valido verfica que sea correcto',
            'nombre.regex' => 'El campo nombre solo debe contener letras y espacios',
            'nombre.max' => 'El campo nombre no debe contener más de 100 caracteres',
            'numero_talonario.size' => 'El campo numero de talonario debe tener 7 caracteres',
            'email.email' => 'El campo email debe ser un email valido',
            'email.unique' => 'El email ya esta registrado para otro cliente',
            'fecha_nacimiento' => 'La fecha de nacimiento debe ser mayor a 18 años',
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
