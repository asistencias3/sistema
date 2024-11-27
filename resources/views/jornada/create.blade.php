@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Jornada</h1>
    <form action="{{ route('jornada.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="normal">Normal</option>
                <option value="extra">Extra</option>
            </select>
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
        </div>

        <div class="form-group">
            <label for="hora_salida">Hora de Salida</label>
            <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
        </div>

        <div class="form-group">
            <label for="inicio_descanso">Inicio de Descanso</label>
            <input type="time" class="form-control" id="inicio_descanso" name="inicio_descanso">
        </div>

        <div class="form-group">
            <label for="fin_descanso">Fin de Descanso</label>
            <input type="time" class="form-control" id="fin_descanso" name="fin_descanso">
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <input type="text" class="form-control" id="sucursal" name="sucursal" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Jornada</button>
    </form>
</div>
@endsection
