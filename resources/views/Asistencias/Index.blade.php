
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Asistencias</h1>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('asistencias.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Crear Nueva Asistencia
        </a>
        <a href="{{ route('asistencias.filtroPdf') }}" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Reporte
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Segunda Entrada</th>
                <th>Segunda Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->empleadoSucursal->name }}</td> 
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_entrada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>
                    <td>{{ $asistencia->hora_segunda_entrada ?? 'N/A' }}</td>
                    <td>{{ $asistencia->hora_segunda_salida ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
