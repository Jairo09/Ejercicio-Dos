@extends('layouts.plantilla')

@section('title', 'login')

@section('content')

    <main class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br><br>
                <div class="card">
                    <div class="card-header">
                        Iniciar Sesión
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="usuario" class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control @error('usuario') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('usuario') }}"
                                    placeholder="Escriba su Usuario" required>
                                @error('usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contrasenia" class="form-label">Contraseña</label>
                                <input type="password" class="form-control @error('contrasenia') is-invalid @enderror"
                                    name="password" id="password" placeholder="Escriba su Contraseña" required>
                                @error('contrasenia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if (session('creado') == 'ok')
        <div class="alert alert-success notification">
            Usuario creado con éxito, por favor inicia sesión.
        </div>

        <script>
            // Selecciona la notificación
            var notification = document.querySelector('.notification');

            // Espera 5 segundos y luego oculta la notificación
            setTimeout(function() {
                notification.style.display = 'none';
            }, 5000); // 5000 milisegundos (5 segundos)
        </script>
    @endif

@endsection
