@extends('layouts.app')

@section('sidebar')
    @include('layouts._partials.sidebar_empleado')
@endsection

@section('content')
<div class="container">
    <h1>Crear Asistencia</h1>
    <form action="{{ route('empleado.registrar') }}" method="POST">
        @csrf

        <!-- Campo oculto para asignar el ID del empleado logueado -->
        <input type="hidden" name="id_empleado_sucursal" value="{{ auth()->user()->empleado->id }}">

        <!-- Mostrar el nombre del empleado autenticado -->
        <div class="form-group">
            <label for="empleado">Empleado</label>
            <input type="text" id="empleado" class="form-control" value="{{ auth()->user()->name }}" readonly>
        </div>

        <!-- Fecha actual -->
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}" readonly>
        </div>

        <!-- Hora de entrada -->
        <div class="form-group">
            <label for="hora_entrada">Hora Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="{{ now()->format('H:i') }}" readonly>
        </div>

        <!-- Hora de salida -->
        <div class="form-group">
            <label for="hora_salida">Hora Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" required>
        </div>

        <!-- Opcionales -->
        <div class="form-group">
            <label for="hora_segunda_entrada">Segunda Entrada (opcional)</label>
            <input type="time" name="hora_segunda_entrada" id="hora_segunda_entrada" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_segunda_salida">Segunda Salida (opcional)</label>
            <input type="time" name="hora_segunda_salida" id="hora_segunda_salida" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
    </form>
</div>
@endsection
