@section('sidebar')
@include('layouts._partials.sidebar_empleado')
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex">
            <div class="flex-1">
                <h1 class="text-2xl font-bold">Historial de Jornadas</h1>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Tipo</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Inicio de Descanso</th>
                    <th>Fin de Descanso</th>
                    <th>Sucursal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($jornadas as $jornada)
                    <tr>
                        <td>{{ $jornada->fecha_inicio }}</td>
                        <td>{{ $jornada->fecha_fin }}</td>
                        <td>{{ $jornada->tipo }}</td>
                        <td>{{ $jornada->hora_entrada }}</td>
                        <td>{{ $jornada->hora_salida }}</td>
                        <td>{{ $jornada->inicio_descanso }}</td>
                        <td>{{ $jornada->fin_descanso }}</td>
                        <td>{{ $jornada->sucursal }}</td>
                        <td>
                            <div class="flex">
                                <a href="{{ route('empleado.jornadas.show', ['id' => $jornada->id]) }}">Ver detalles</a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
