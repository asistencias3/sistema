@extends('layouts.app')

@section('sidebar')
    @include('layouts._partials.sidebar_empleado')
@endsection

@section('content')
<div class="content-container">
    <a href="{{ route('empleado.asistencia.pdf') }}" class="btn btn-primary">Descargar PDF</a>

    <div class="header">
        <h1>Reporte de Asistencias</h1>
    </div>

    <!-- Tabla de Reporte -->
    <table class="asistencia-table">
        <thead>
            <tr>
                <th>ID Empleado</th>
                <th>ID jornada</th>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id_empleado }}</td>
                    <td>{{ $asistencia->id_jornadas }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_entrada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('styles')
    <style>
        .content-container {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .asistencia-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .asistencia-table th, .asistencia-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .asistencia-table th {
            background-color: #4CAF50;
            color: white;
        }

        .asistencia-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .asistencia-table tr:hover {
            background-color: #ddd;
        }

        .asistencia-table td {
            font-size: 14px;
            color: #555;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
@endsection