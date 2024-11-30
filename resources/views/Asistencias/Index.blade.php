<!-- resources/views/Asistencias/Index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Asistencias</h1>

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
                    <td>{{ $asistencia->empleadoSucursal->name }}</td> <!-- Nombre del empleado -->
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
