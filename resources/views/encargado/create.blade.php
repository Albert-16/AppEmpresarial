<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="actividades"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Crear Actividad"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear un nuevo encargado</h4>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger text-white">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            {{-- Formulario para crear un encargado nuevo --}}
                            <form action="{{ route('encargado.store') }}" method="POST">
                                @csrf
                                {{-- Nombre del encargado --}}
                                <div class="form-group">
                                    <label for="nombre_encargado">Nombre del Encargado</label>
                                    <input type="text" name="nombre_encargado"
                                        class="form-control bg-light p-2 @error('nombre_encargado') is-invalid @enderror"
                                        value="{{ old('nombre_encargado') }}" required>
                                    @error('nombre_encargado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Telefono--}}
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
                                    {{-- email--}}
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

                                {{-- Estado --}}
                                <div class="form-group  mt-2">
                                    <label for="id_estado_encargado">Estado</label>
                                    <select name="id_estado_encargado"
                                        class="form-control bg-light p-2 @error('id_estado_encargado') is-invalid @enderror"
                                        required>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->id_estado_encargado }}"
                                                {{ old('id_estado_encargado') == $estado->id_estado_encargado ? 'selected' : '' }}>
                                                {{ $estado->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_estado_encargado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Botón para guardar --}}
                                <div class="form-group d-flex justify-content-end mt-3">
                                    <div class="mr-3">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="{{ route('encargado.index') }}" role="button"
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
