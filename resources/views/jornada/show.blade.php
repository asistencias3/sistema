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

    <button id="escanearQr" class="btn btn-primary mt-3">Escanear QR y Registrar Asistencia</button>
    <a href="{{ route('jornada.index') }}" class="btn btn-secondary mt-3">Volver al Historial</a>
</div>

<script>
 document.getElementById('escanearQr').addEventListener('click', async function () {
    const payload = {
        jornada_id: {{ $jornada->id }},
        token: "{{ $jornada->qr_token }}",
        id_empleado: {{ auth()->user()->id }}
    };

    console.log('Payload enviado:', payload);

    try {
        const response = await fetch('/registrar-asistencia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();
        console.log('Respuesta recibida:', data);

        if (data.success) {
            alert('Asistencia registrada exitosamente.');
        } else {
            alert('Error al registrar asistencia: ' + data.message);
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
        alert('Ocurrió un error al registrar la asistencia. Intente nuevamente.');
    }
});

</script>
@endsection
