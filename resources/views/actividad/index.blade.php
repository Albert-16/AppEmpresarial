<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="actividades"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Actividades"></x-navbars.navs.auth>
        @if (session('success'))
            <div id="alert" class="alert alert-success text-center text-white" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>Listado de Actividades</h4>
                        </div>
                        <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Add, Edit, Delete features are not
                                        functional!</strong> This is a<strong> PRO</strong> feature! Click
                                    <strong><a
                                            href="https://www.creative-tim.com/product/material-dashboard-pro-laravel"
                                            target="_blank" class="text-white"><u>here</u> </a></strong>to see
                                    the PRO product!</h6>
                            </div>
                        </div> -->
                        <div class="me-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('actividad.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Nueva Actividad</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Descripción</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Encargado</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Empresa</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha de inicio</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha de finalización</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Estado
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Acciones
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actividades as $actividad)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $actividad->id_actividad }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $actividad->nombre_actividad }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $actividad->descripcion }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $actividad->encargado->nombre_encargado }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">

                                                        <h6 class="mb-0 text-sm">
                                                            {{ $actividad->empresa->nombre }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $actividad->fecha_inicio }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $actividad->fecha_finalizacion }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $actividad->costo }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <div class="form-group">
                                                        <select class="form-control" id="estado" name="estado"
                                                            disabled>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id_estado }}"
                                                                    {{ $actividad->estado->descripcion == $estado->descripcion ? 'selected' : '' }}>
                                                                    {{ $estado->descripcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                                <td class="align-bottom text-center">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('actividad.edit', $actividad->id_actividad) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <!-- <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
