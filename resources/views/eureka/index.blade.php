<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="eureka"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Eureka"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-lg">
            <div>
                <a class='btn bg-info opacity-7 text-white font-weight-bolder' href="{{route('cliente.index')}}">Clientes Eureka</a>
            </div>
            {{-- Tabla Actividades Completadas --}}
            <div class="row py-4 justify-content-center">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Actividades</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $actividadesCompletadas }}</span>
                                    Completadas
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                            Ingreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Egreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableActividadesCompletadas as $actividad)
                                        <tr>
                                            <td class="text-wrap">
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
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->costo), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->egresos), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->total), 2 }}</span>
                                            </td>
                                            <td class="align-bottom text-center">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('actividad.edit', $actividad->id_actividad) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabla en Proceso --}}
            <div class="row py-4 justify-content-center">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Actividades</h6>
                                <p class="text-sm mb-0">
                                    <i class="fas fa-spinner text-warning" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $actividadesProceso }}</span>
                                    En Proceso
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                            Ingreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Egreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableActividadesProceso as $actividad)
                                        <tr>
                                            <td class="text-wrap">
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
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->costo), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->egresos), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->total), 2 }}</span>
                                            </td>
                                            <td class="align-bottom text-center">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('actividad.edit', $actividad->id_actividad) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabla Actividades Canceladas --}}
            <div class="row py-4 justify-content-center">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Actividades</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $actividadesCanceladas }}</span>
                                    Canceladas
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
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
                                            Ingreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Egreso
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableActividadesCanceladas as $actividad)
                                        <tr>
                                            <td class="text-wrap">
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
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->costo), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->egresos), 2 }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $datosGanancias['moneda'] }}{{ number_format($actividad->total), 2 }}</span>
                                            </td>
                                            <td class="align-bottom text-center">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('actividad.edit', $actividad->id_actividad) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
