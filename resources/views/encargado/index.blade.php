<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="encargados"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Encargados"></x-navbars.navs.auth>
        <!-- End Navbar -->
        @if (session('success'))
            <div id="alert" class="alert alert-success text-center text-white" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>Listado de Encargados</h4>
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
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('encargado.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Nuevo Encargado</a>
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
                                                Telefóno</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Dirección</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Correo Electrónico</th>

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
                                        @foreach ($encargados as $encargado)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $encargado->id_encargado }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- nombre --}}
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $encargado->nombre_encargado }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- telefono --}}
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $encargado->telefono }}</h6>
                                                    </div>
                                                </td>
                                                {{-- direccion --}}
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $encargado->direccion }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                {{-- email --}}
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $encargado->email }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                {{-- Estadoss --}}
                                                <td class="align-middle text-center">
                                                    <div class="form-group">
                                                        <select class="form-control text-center" id="estado"
                                                            name="estado" disabled>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id_estado_encargado }}"
                                                                    {{ $encargado->estadoEncargado->descripcion == $estado->descripcion ? 'selected' : '' }}>
                                                                    {{ $estado->descripcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="align-bottom text-center">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('encargado.edit', $encargado->id_encargado) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
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
