@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Detalles de la Jornada</h1>
    
    <!-- Detalles de la Jornada -->
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

    <!-- Código QR -->
    <div class="my-4">
        <h4 class="text-xl font-semibold">QR de la Jornada</h4>
        <div class="my-3">
            {!! QrCode::size(300)->generate(route('jornada.show', $jornada->id)) !!}
        </div>
    </div>

    <!-- Botón para escanear QR y registrar asistencia -->
    <button id="escanearQr" class="btn btn-primary mt-3">Escanear QR y Registrar Asistencia</button>

    <!-- Enlace para regresar al historial -->
    <a href="{{ route('jornada.index') }}" class="btn btn-secondary mt-3">Volver al Historial</a>
</div>

<script>
    document.getElementById('escanearQr').addEventListener('click', async function () {
        // Obtener datos del usuario desde localStorage
        const usuario = JSON.parse(localStorage.getItem('usuario'));
        if (!usuario) {
            alert('No se encontró información del usuario. Inicie sesión nuevamente.');
            return;
        }

        // Datos del QR
        const qrData = {
            jornada_id: {{ $jornada->id }},
            fecha: "{{ $jornada->fecha_inicio }}",
            hora_entrada: "{{ $jornada->hora_entrada }}"
        };

        // Combinar datos
        const payload = {
            id_usuario: usuario.id,
            ...qrData
        };

        try {
            // Enviar datos al backend
            const response = await fetch('/registrar-asistencia', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();
            if (data.success) {
                alert('Asistencia registrada exitosamente.');
            } else {
                alert('Error al registrar asistencia: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ocurrió un error al registrar la asistencia. Intente nuevamente.');
        }
    });
</script>

@endsection
