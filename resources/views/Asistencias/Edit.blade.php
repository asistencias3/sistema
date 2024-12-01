@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Asistencia</h1>

    <form action="{{ route('asistencias.update', $asistencia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_empleado_sucursal">Empleado</label>
            <select name="id_empleado_sucursal" id="id_empleado_sucursal" class="form-control" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" 
                        {{ $empleado->id == $asistencia->id_empleado_sucursal ? 'selected' : '' }}>{{ $empleado->name }}</option>
                @endforeach
            </select>
            @error('id_empleado_sucursal')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $asistencia->fecha }}" required>
            @error('fecha')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
<div class="form-group">
    <label for="hora_entrada">Hora Entrada</label>
    <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" 
           value="{{ $asistencia->hora_entrada ? $asistencia->hora_entrada->format('H:i') : '' }}" required>
    @error('hora_entrada')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="hora_salida">Hora Salida</label>
    <input type="time" name="hora_salida" id="hora_salida" class="form-control" 
           value="{{ $asistencia->hora_salida ? $asistencia->hora_salida->format('H:i') : '' }}" required>
    @error('hora_salida')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="hora_segunda_entrada">Segunda Entrada (opcional)</label>
    <input type="time" name="hora_segunda_entrada" id="hora_segunda_entrada" class="form-control" 
           value="{{ $asistencia->hora_segunda_entrada ? $asistencia->hora_segunda_entrada->format('H:i') : '' }}">
    @error('hora_segunda_entrada')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="hora_segunda_salida">Segunda Salida (opcional)</label>
    <input type="time" name="hora_segunda_salida" id="hora_segunda_salida" class="form-control" 
           value="{{ $asistencia->hora_segunda_salida ? $asistencia->hora_segunda_salida->format('H:i') : '' }}">
    @error('hora_segunda_salida')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

        <button type="submit" class="btn btn-primary">Actualizar Asistencia</button>
    </form>
</div>
@endsection
