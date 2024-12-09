@section('sidebar')
@include('layouts._partials.sidebar_empleado')
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Detalles de la Jornada</h1>
    
    <div class="my-4">
        <p><strong>Fecha de Inicio:</strong> {{ $jornada->fecha_inicio }}</p>
        <p><strong>Fecha de Fin:</strong> {{ $jornada->fecha_fin }}</p>
        <p><strong>Tipo:</strong> {{ $jornada->tipo }}</p>
        <p><strong>Hora de Entrada:</strong> {{ $jornada->hora_entrada }}</p>
        <p><strong>Hora de Salida:</strong> {{ $jornada->hora_salida }}</p>
        <p><strong>Inicio de Descanso:</strong> {{ $jornada->inicio_descanso }}</p>
        <p><strong>Fin de Descanso:</strong> {{ $jornada->fin_descanso }}</p>
        <p><strong>Sucursal:</strong> {{ $jornada->sucursal }}</p>
    </div>

    <div class="my-4">
        <h4 class="text-xl font-semibold">QR de la Jornada</h4>
        <div class="my-3">
            {!! QrCode::size(300)->generate(json_encode([
                'jornada_id' => $jornada->id,
                'token' => $jornada->qr_token,
                'fecha' => $jornada->fecha_inicio,
            ])) !!}
        </div>
    </div>

    <form action="{{ route('empleado.registrar') }}" method="POST">
    @csrf
<!-- Campos ocultos para la asistencia -->
<input type="hidden" name="jornada_id" value="{{ $jornada->id }}">
<input type="hidden" name="estado" value="1">
<input type="hidden" name="fecha" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
<input type="hidden" name="hora_entrada" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
<input type="hidden" name="hora_salida" value="">


    <!-- Botón de envío -->
    <button type="submit" class="btn btn-success">Registrar Asistencia</button>
</form>

</form>

</form>

</form>

    <a href="{{ route('empleado.asistencia') }}" class="btn btn-secondary mt-3">Volver al Historial</a>
</div>

@endsection
