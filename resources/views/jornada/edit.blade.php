@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Jornada</h1>
    
    <form action="{{ route('jornada.update', $jornada->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $jornada->fecha_inicio) }}" required>
            @error('fecha_inicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $jornada->fecha_fin) }}" required>
            @error('fecha_fin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                <option value="normal" {{ old('tipo', $jornada->tipo) == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="extra" {{ old('tipo', $jornada->tipo) == 'extra' ? 'selected' : '' }}>Extra</option>
            </select>
            @error('tipo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" class="form-control @error('hora_entrada') is-invalid @enderror" id="hora_entrada" name="hora_entrada" value="{{ old('hora_entrada', $jornada->hora_entrada) }}" required>
            @error('hora_entrada')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_salida">Hora de Salida</label>
            <input type="time" class="form-control @error('hora_salida') is-invalid @enderror" id="hora_salida" name="hora_salida" value="{{ old('hora_salida', $jornada->hora_salida) }}" required>
            @error('hora_salida')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inicio_descanso">Inicio de Descanso</label>
            <input type="time" class="form-control @error('inicio_descanso') is-invalid @enderror" id="inicio_descanso" name="inicio_descanso" value="{{ old('inicio_descanso', $jornada->inicio_descanso) }}">
            @error('inicio_descanso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fin_descanso">Fin de Descanso</label>
            <input type="time" class="form-control @error('fin_descanso') is-invalid @enderror" id="fin_descanso" name="fin_descanso" value="{{ old('fin_descanso', $jornada->fin_descanso) }}">
            @error('fin_descanso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <input type="text" class="form-control @error('sucursal') is-invalid @enderror" id="sucursal" name="sucursal" value="{{ old('sucursal', $jornada->sucursal) }}" required>
            @error('sucursal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Jornada</button>
    </form>
</div>
@endsection
