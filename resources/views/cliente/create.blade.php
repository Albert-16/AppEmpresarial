<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="eureka"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Registrar Cliente"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Registrar un nuevo cliente</h4>
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
                            {{-- Formulario para crear un cliente nuevo --}}
                            <form action="{{ route('cliente.store') }}" method="POST">
                                @csrf
                                {{-- identidad --}}
                                <div class="form-group">
                                    <label for="identidad">Identidad</label>
                                    <input type="text" name="identidad"
                                        class="form-control bg-light p-2 @error('identidad') is-invalid @enderror"
                                        value="{{ old('identidad') }}" required>
                                    @error('identidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Nombre del cliente --}}
                                <div class="form-group">
                                    <label for="nombre">Nombre del Cliente</label>
                                    <input type="text" name="nombre"
                                        class="form-control bg-light p-2 @error('nombre') is-invalid @enderror"
                                        value="{{ old('nombre') }}" required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Telefono --}}
                                <div class="form-group">
                                    <label for="telefono">Número Telefónico</label>
                                    <input type="text" name="telefono"
                                        class="form-control bg-light p-2 @error('telefono') is-invalid @enderror"
                                        value="{{ old('telefono') }}" required>
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
                                        value="{{ old('direccion') }}" required>
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
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Fecha de nacimiento --}}
                                <div class="form-group  mt-2">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento"
                                        class="form-control p-2 bg-light @error('fecha_nacimiento') is-invalid @enderror"
                                        value="{{ old('fecha_nacimiento') }}" required>
                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Referencia  --}}
                                <div class="form-group">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" name="referencia"
                                        class="form-control bg-light p-2 @error('referencia') is-invalid @enderror"
                                        value="{{ old('referencia') }}" required>
                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Numero de Talonario  --}}
                                <div class="form-group">
                                    <label for="numero_talonario">Número de Talonario</label>
                                    <input type="text" name="numero_talonario"
                                        class="form-control bg-light p-2 @error('numero_talonario') is-invalid @enderror"
                                        value="{{ old('numero_talonario') }}" required>
                                    @error('numero_talonario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Estado --}}
                                <div class="form-group  mt-2">
                                    <label for="id_estado_cliente">Estado</label>
                                    <select name="id_estado_cliente"
                                        class="form-control bg-light p-2 @error('id_estado_cliente') is-invalid @enderror"
                                        required>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->id_estado_cliente }}"
                                                {{ old('id_estado_cliente') == $estado->id_estado_cliente ? 'selected' : '' }}>
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
                                        <button type="submit" class="btn btn-success">Guardar</button>
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
