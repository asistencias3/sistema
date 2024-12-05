@section('sidebar')
@include('layouts._partials.sidebar_admin')

@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Usuarios</h1>
            <a href="{{ route('users.create') }}" class="btn bg-[#004643] text-[#fdfcfd] font-semibold hover:">Nuevo Usuario</a>
        </div>

        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->rol == 1)
                                Administración
                            @elseif ($user->rol == 2)
                                Recursos humanos
                            @else
                                Empleado
                            @endif
                        </td>
                        <td>
                            <div class="flex place-content-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn bg-yellow-600 text-[#fdfcfd] font-semibold m-2">Editar</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red-500 text-[#fdfcfd] font-semibold m-2">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
