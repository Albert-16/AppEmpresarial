<x-layout bodyClass="">

    <div>
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">

            </div>
        </div>
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div
                                class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                    style="background-image: url('../assets/img/sanate.jpg'); background-size: cover;">
                                </div>
                            </div>
                            <div
                                class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                                <div class="card card-plain">
                                    
                                    <div class="card-header">
                                        <h4 class="font-weight-bolder">Registrate</h4>
                                        <p class="mb-0">Ingresa tu nombre, correo electrónico y contraseña para
                                            registrarte</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control bg-light p-2" name="name"
                                                    value="{{ old('name') }}" placeholder="Nombre De Ejemplo">
                                            </div>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="form-group mt-2">
                                                <label class="form-label text-bold">Correo electrónico</label>
                                                <input type="email"
                                                    class="form-control bg-light p-2"value="{{ old('email') }}"
                                                    name="email"
                                                    placeholder="email@email.com">
                                            </div>
                                            @error('email')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="form-group mt-2">
                                                <label class="form-label text-bold">Contraseña</label>
                                                <input type="password" class="form-control bg-light p-2" name="password" id="password" placeholder="1234578">
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
                                                <button type="submit"
                                                    class="btn btn-lg bg-info text-white btn-lg w-100 mt-4 mb-0">Registrarse</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-2 text-sm mx-auto">
                                            ¿Ya tienes una cuenta?
                                            <a href="{{ route('login') }}"
                                                class="text-info text-gradient font-weight-bold">Ingresa</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

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
