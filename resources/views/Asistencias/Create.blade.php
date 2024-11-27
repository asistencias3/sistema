@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registro de Asistencia</h1>
    <form action="{{ route('asistencias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_empleado_sucursal">Empleado</label>
            <input type="number" name="id_empleado_sucursal" id="id_empleado_sucursal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hora_salida">Hora de Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
