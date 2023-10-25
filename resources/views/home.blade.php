@extends('layouts.plantilla')

@section('title', 'home')

@section('content')
    <div>
        <h3>Usuarios</h3>
    </div>
    <div>
        <a href="{{ route('register') }}" class="btn btn-primary">Crear Usuario</a>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form class='formulario-eliminar' method="POST" action="{{ route('userdelete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('creado') == 'ok')
        <div class="alert alert-success notification">
            Usuario creado con éxito.
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

    @if (session('eliminar') == 'Ok')
        @php
            $swalType = 'success';
            $swalTitle = 'Eliminado';
            $swalText = 'El Usuario ha sido eliminado.';
        @endphp
    @elseif (session('eliminar') == 'Error')
        @php
            $swalType = 'error';
            $swalTitle = 'Error al Eliminar';
            $swalText = 'Este Usuario no puede ser eliminado';
        @endphp
    @endif

    @if (isset($swalType))
        <script>
            Swal.fire({
                icon: '{{ $swalType }}',
                title: '{{ $swalTitle }}',
                text: '{{ $swalText }}',
            });
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro de eliminar este usuario?',
                text: "No podrás volver a recuperarlo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Borrar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })

        });
    </script>

@endsection
