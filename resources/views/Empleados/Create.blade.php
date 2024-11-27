@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Empleado</h1>
    <form action="{{ route('empleado.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="usuario" class="form-label">Selecciona un Usuario</label>
            <select name="id_usuario" id="usuario" class="form-select" required>
                <option value="" selected disabled>-- Selecciona un Usuario --</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} (ID: {{ $usuario->id }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sucursal" class="form-label">Sucursal</label>
            <input type="text" name="sucursal" id="sucursal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
