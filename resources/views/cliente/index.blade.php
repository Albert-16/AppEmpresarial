<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="eureka"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Clientes de Eureka"></x-navbars.navs.auth>
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
                            <h4>Listado de Clientes de Eureka</h4>
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
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('cliente.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Nuevo Cliente</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                # de indentidad
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Teléfono</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Dirección</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha de Nacimiento</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Referencia</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Número de Talonario</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Estado
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Acciones
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $cliente)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">
                                                                {{ str_pad($cliente->identidad, 13, '0', STR_PAD_LEFT) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $cliente->nombre }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $cliente->telefono }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $cliente->direccion }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td class="text-wrap">
                                                    <div class="d-flex flex-column justify-content-center">

                                                        <h6 class="mb-0 text-sm">
                                                            {{ $cliente->email }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $cliente->fecha_nacimiento }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $cliente->referencia }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $cliente->numero_talonario }}
                                                    </p>
                                                <td class="align-middle text-center">

                                                    <div class="form-group">
                                                        <select class="form-control" id="estado" name="estado"
                                                            disabled>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id_estado_cliente }}"
                                                                    {{ $cliente->estado->descripcion == $estado->descripcion ? 'selected' : '' }}>
                                                                    {{ $estado->descripcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                                <td class="align-bottom text-center">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('cliente.edit', str_pad($cliente->identidad, 13, '0', STR_PAD_LEFT)) }}"
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
