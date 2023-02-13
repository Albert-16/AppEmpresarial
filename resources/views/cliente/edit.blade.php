<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="eureka"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Actualizar Cliente"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Actualizar Cliente</h4>
                        </div>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            {{-- Formulario para actualizar cliente --}}
                            <form action="{{ route('cliente.update',str_pad($cliente->identidad, 13, '0', STR_PAD_LEFT)) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- identidad --}}
                                <div class="form-group">
                                    <label for="identidad">Número de identidad</label>
                                    <input type="text" name="identidad"
                                        class="form-control bg-light p-2 @error('identidad') is-invalid @enderror"
                                        value="{{ old('identidad', str_pad($cliente->identidad, 13, '0', STR_PAD_LEFT)) }}" required>
                                    @error('identidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                {{-- Nombre Cliente --}}
                                <div class="form-group">
                                    <label for="nombre">Nombre del Cliente</label>
                                    <input type="text" name="nombre"
                                        class="form-control bg-light p-2 @error('nombre') is-invalid @enderror"
                                        value="{{ old('nombre', $cliente->nombre) }}" required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Telefono --}}
                                <div class="form-group">
                                    <label for="telefono">Telefóno</label>
                                    <input type="text" name="telefono"
                                        class="form-control bg-light p-2 @error('telefono') is-invalid @enderror"
                                        value="{{ old('telefono', $cliente->telefono) }}" required>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Direccion  --}}
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" name="direccion"
                                        class="form-control bg-light p-2 @error('direccion') is-invalid @enderror"
                                        value="{{ old('direccion', $cliente->direccion) }}" required>
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Correo --}}
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="text" name="email"
                                        class="form-control bg-light p-2 @error('email') is-invalid @enderror"
                                        value="{{ old('email', $cliente->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Fecha de Nacimiento --}}
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento"
                                        class="form-control bg-light p-2 @error('fecha_nacimiento') is-invalid @enderror"
                                        value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" required>
                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Referencia --}}
                                <div class="form-group">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" name="referencia"
                                        class="form-control bg-light p-2 @error('referencia') is-invalid @enderror"
                                        value="{{ old('referencia', $cliente->referencia) }}" required>
                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Numero de Talonario --}}
                                <div class="form-group">
                                    <label for="numero_talonario">Número de Talonario</label>
                                    <input type="text" name="numero_talonario"
                                        class="form-control bg-light p-2 @error('numero_talonario') is-invalid @enderror"
                                        value="{{ old('numero_talonario', $cliente->numero_talonario) }}" required>
                                    @error('numero_talonario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- Estado --}}
                                    <div class="form-group mt-2 ">
                                        <label for="id_estado_cliente">Estado</label>
                                        <select name="id_estado_cliente"
                                            class="form-control bg-light p-2 @error('id_estado_cliente') is-invalid @enderror"
                                            required>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id_estado_cliente }}"
                                                    {{ old('id_estado', $cliente->id_estado_cliente) == $estado->id_estado_cliente ? 'selected' : '' }}>
                                                    {{ $estado->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_estado_cliente')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Botón para guardar --}}
                                    <div class="form-group d-flex justify-content-end mt-3">
                                        <div class="mr-3">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="{{ route('cliente.index') }}" role="button"
                                                class="btn btn-danger ml-auto">Cancelar</a>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
</x-layout>
