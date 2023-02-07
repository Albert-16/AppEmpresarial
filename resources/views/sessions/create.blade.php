<x-layout bodyClass="bg-gray-200">
    <!-- antiguo navbar -->
    <!-- <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12"> -->
    <!-- Navbar -->
    <!-- <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest> -->
    <!-- End Navbar -->
    <!-- </div>
            </div>
        </div> -->
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container mt-5">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div
                                    class="bg-info shadow-primary border-radius-lg d-flex align-items-center justify-content-center py-3 pe-1">
                                    <img src="{{ asset('assets/img/user.png') }}"
                                        class="img-fluid img-thumbnail w-25 h-25 py-2"  style="margin-right: 10px;" alt="">
                                    <h4 class="text-white font-weight-bolder mb-0 py-3">Ingresar</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                                    @csrf
                                    @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="form-group mt-2">
                                        <label class="form-label text-bold">Correo electrónico</label>
                                        <input type="email" class="form-control bg-light p-2" name="email"
                                            autocomplete="current-password" placeholder="email@email.com">
                                    </div>
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="form-group mt-2">
                                        <label class="form-label text-bold">Contraseña</label>
                                        <input type="password" class="form-control bg-light p-2" name="password"
                                            id="password" autocomplete="current-password" placeholder="1234578">
                                    </div>
                                    @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="form-check form-switch d-flex align-items-center my-3 mt-2">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label mb-0 ms-2" for="rememberMe">Mostrar contraseña
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="text-white btn bg-info w-100 my-4 mb-2">Ingresar
                                        </button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        ¿Aún no tienes cuenta?
                                        <a href="{{ route('register') }}"
                                            class="text-info text-gradient font-weight-bold">Registrate</a>
                                    </p>
                                    <p class="text-sm text-center">
                                        ¿Olvidaste tu contraseña? Restablece tu contraseña
                                        <a href="{{ route('verify') }}"
                                            class="text-info text-gradient font-weight-bold">¡Aquí!</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
    @push('js')
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script>
            $(function() {

                var text_val = $(".input-group input").val();
                if (text_val === "") {
                    $(".input-group").removeClass('is-filled');
                } else {
                    $(".input-group").addClass('is-filled');
                }
            });
        </script>
    @endpush
</x-layout>
