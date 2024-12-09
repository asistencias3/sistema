@extends('layouts.app')
@section('sidebar')
@include('layouts._partials.sidebar_admin')

@endsection


@section('content')
<div class="container">
    <h1 class="text-2xl font-bold text-[#004643]">Registrar Empleado</h1>
    <form action="{{ route('empleado.store') }}" method="POST" class="w-full bg-[#f6f4f5] p-6 rounded">
        @csrf
        <div class="mb-3">
            <label for="usuario" class="form-label">Selecciona un Usuario</label>
            <select name="id_usuario" id="usuario" class="form-select appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                <option value="" selected disabled>-- Selecciona un Usuario --</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} (ID: {{ $usuario->id }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>
        <div class="mb-3">
            <label for="sucursal" class="form-label">Sucursal</label>
            <input type="text" name="sucursal" id="sucursal" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>
        <button type="submit" class="btn bg-[#004643] text-[#fdfcfd] font-semibold">Guardar</button>
        <a href="{{ route('empleado.index') }}" class="btn bg-red-500 text-[#fdfcfd] font-semibold">Cancelar</a>
    </form>
</div>
@endsection
