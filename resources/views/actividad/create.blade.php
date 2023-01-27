<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="actividades"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Crear Actividad"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear Actividad</h4>
                        </div>
                        <div class="card-body">
                            {{-- Formulario para crear una nueva actividad --}}
                            <form action="{{ route('actividad.store') }}" method="POST">
                                @csrf
                                {{-- Nombre de la actividad --}}
                                <div class="form-group">
                                    <label for="nombre_actividad">Nombre de la actividad</label>
                                    <input type="text" name="nombre_actividad" class="form-control bg-light p-2 @error('nombre_actividad') is-invalid @enderror" value="{{ old('nombre_actividad') }}" required>
                                    @error('nombre_actividad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Descripción de la actividad --}}
                                <div class="form-group  mt-2">
                                    <label for="descripcion">Descripción de la actividad</label>
                                    <textarea name="descripcion" class="form-control bg-light p-2 @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                    <span class="invalid
                                        -feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Encargado --}}
                                <div class="form-group">
                                    <label for="id_encargado">Encargado</label>
                                    <select name="id_encargado" class="form-control p-2 bg-light @error('id_encargado') is-invalid @enderror">
                                        @foreach($encargadosActivos as $encargado)
                                        <option value="{{ $encargado->id_encargado }}">{{ $encargado->nombre_encargado }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_encargado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                {{-- Empresa --}}
                                <div class="form-group">
                                    <label for="id_empresa">Empresa</label>
                                    <select name="id_empresa" class="form-control p-2 bg-light @error('id_empresa') is-invalid @enderror">
                                        @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_empresa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Fecha de inicio --}}
                                <div class="form-group  mt-2">
                                    <label for="fecha_inicio">Fecha de inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control p-2 bg-light @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio') }}" required>
                                    @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Fecha de finalización --}}
                                <div class="form-group  mt-2">
                                    <label for="fecha_finalizacion">Fecha de finalización</label>
                                    <input type="date" name="fecha_finalizacion" class="form-control p-2 bg-light @error('fecha_finalizacion') is-invalid @enderror" value="{{ old('fecha_finalizacion') }}" required>
                                    @error('fecha_finalizacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Costo --}}
                                <div class="form-group mt-2">
                                    <label for="costo">Costo</label>
                                    <input type="number" name="costo" class="form-control p-2 bg-light @error('costo') is-invalid @enderror" value="{{ old('costo') }}" required>
                                    @error('costo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Estado --}}
                                <div class="form-group  mt-2">
                                    <label for="id_estado">Estado</label>
                                    <select name="id_estado" class="form-control bg-light p-2 @error('id_estado') is-invalid @enderror" required>
                                        @foreach($estados as $estado)
                                        <option value="{{ $estado->id_estado }}" {{ old('id_estado') == $estado->id_estado ? 'selected' : '' }}>{{ $estado->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- Botón para guardar --}}
                                <div class="form-group d-flex justify-content-end mt-3">
                                    <div class="mr-3">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="{{route('actividad.index')}}" role="button" class="btn btn-danger ml-auto">Cancelar</a>
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