@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Filtrar Reporte de Asistencias</h1>
    <form action="{{ route('asistencias.generarPdf') }}" method="GET">
        <div class="form-group">
            <label for="rol">Seleccionar Rol</label>
            <select name="rol" id="rol" class="form-control">
                <option value="">-- Selecciona un Rol --</option>
                @foreach ($roles as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generar PDF</button>
    </form>
</div>
@endsection
