@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold text-[#004643]">Editar Asistencia</h1>
    <form action="{{ route('asistencias.update', $asistencia->id) }}" method="POST" class="w-full bg-[#f6f4f5] p-6 rounded">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_empleado_sucursal">Empleado</label>
            <input type="number" name="id_empleado_sucursal" id="id_empleado_sucursal" value="{{ $asistencia->id_empleado_sucursal }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{ $asistencia->fecha }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
