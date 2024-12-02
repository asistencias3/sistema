{{-- Vista general de usuarios --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex">
            <div class="flex-1">
                <h1 class="text-2xl font-bold">Usuarios</h1>
            </div>
            <div class="object-left">
                <a href="#" class="btn bg-[#004643] text-[#fdfcfd] font-semibold hover:">Nuevo
                    Usuario</a>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                    <th>Id</th>
                    <th>User</th>
                    <th>Tipo</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>ejemplo</td>
                    <td>ejemplo</td>
                    <td>ejemplo</td>
                    <td>ejemplo</td>
                    <td>ejemplo</td>
                    <td>
                        <div class="flex place-content-center">
                            <a href="#" class="btn bg-[#2e6765] text-[#fdfcfd] font-semibold m-2">Ver</a>
                            <a href="#" class="btn bg-yellow-600 text-[#fdfcfd] font-semibold m-2">Editar</a>
                            <form action="#" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn bg-red-500 text-[#fdfcfd] font-semibold m-2">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
