@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Jornada</h1>

    <table class="table">
        <tr>
            <th>Fecha Inicio:</th>
            <td>{{ $jornada->fecha_inicio }}</td>
        </tr>
        <tr>
            <th>Fecha Fin:</th>
            <td>{{ $jornada->fecha_fin }}</td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td>{{ $jornada->tipo }}</td>
        </tr>
        <tr>
            <th>Hora de Entrada:</th>
            <td>{{ $jornada->hora_entrada }}</td>
        </tr>
        <tr>
            <th>Hora de Salida:</th>
            <td>{{ $jornada->hora_salida }}</td>
        </tr>
        <tr>
            <th>Inicio de Descanso:</th>
            <td>{{ $jornada->inicio_descanso }}</td>
        </tr>
        <tr>
            <th>Fin de Descanso:</th>
            <td>{{ $jornada->fin_descanso }}</td>
        </tr>
        <tr>
            <th>Sucursal:</th>
            <td>{{ $jornada->sucursal }}</td>
        </tr>
        <tr>
            <th>Código QR:</th>
            <td>{!! $qrCode !!}</td> <!-- Mostrar el QR generado -->
        </tr>
    </table>

    <a href="{{ route('jornada.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
