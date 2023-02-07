<x-layout bodyClass="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-info shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Cambia tu contraseña</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('password.update', ['token' => $token]) }}" class="text-start">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control bg-light p-2" name="email">
                                    </div>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="form-group my-3">
                                        <label class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control bg-light p-2" name="password">
                                    </div>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="form-group my-3">
                                        <label class="form-label">Confirma tu contraseña</label>
                                        <input type="password" class="form-control bg-light p-2" name="password_confirmation">
                                    </div>
                                    @error('password_confirmation')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Cambiar contraseña</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        ¿Aún no tienes cuenta?
                                        <a href="{{ route('register') }}"
                                            class="text-primary text-info font-weight-bold">Registrate</a>
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

</x-layout>
