@section('sidebar')
@include('layouts._partials.sidebar_admin')
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Asistencia</h1>

    <form action="{{ route('asistencias.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_empleado_sucursal">Empleado</label>
            <select name="id_empleado_sucursal" id="id_empleado_sucursal" class="form-control" required>
                <option value="">Selecciona un empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                @endforeach
            </select>
            @error('id_empleado_sucursal')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
    <label for="id_jornadas">Jornada</label>
    <select name="id_jornadas" id="id_jornadas" class="form-control" required>
        <option value="">Selecciona una jornada</option>
        @foreach($jornadas as $jornada)
        <option value="{{ $jornada->id }}">
    Fecha inicio: {{ \Carbon\Carbon::parse($jornada->fecha_inicio)->format('d-m-Y') }} - 
    Fecha fin: {{ \Carbon\Carbon::parse($jornada->fecha_fin)->format('d-m-Y') }} - 
    Hora entrada: {{ \Carbon\Carbon::parse($jornada->hora_entrada)->format('H:i') }} - 
    Hora salida: {{ \Carbon\Carbon::parse($jornada->hora_salida)->format('H:i') }} - 
    Inicio descanso: {{ \Carbon\Carbon::parse($jornada->inicio_descanso)->format('H:i') }} - 
    Fin descanso: {{ \Carbon\Carbon::parse($jornada->fin_descanso)->format('H:i') }} - 
    Sucursal: {{ $jornada->sucursal }}
</option>


</option>

        @endforeach
    </select>
    @error('id_jornadas')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
            @error('fecha')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" required>
            @error('hora_entrada')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_salida">Hora Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" required>
            @error('hora_salida')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_segunda_entrada">Segunda Entrada (opcional)</label>
            <input type="time" name="hora_segunda_entrada" id="hora_segunda_entrada" class="form-control">
            @error('hora_segunda_entrada')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_segunda_salida">Segunda Salida (opcional)</label>
            <input type="time" name="hora_segunda_salida" id="hora_segunda_salida" class="form-control">
            @error('hora_segunda_salida')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
    </form>
</div>
@endsection
