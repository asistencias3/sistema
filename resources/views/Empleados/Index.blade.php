

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold text-[#004643]">Lista de Usuarios</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>
                        <a href="{{ route('empleado.create', ['id_usuario' => $usuario->id]) }}" class="btn bg-[#2e6765] text-[#fdfcfd] font-semibold m-2">Registrar como Empleado</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('sidebar')
@include('layouts._partials.sidebar_admin')
@endsection

