@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Detalles de la Jornada</h1>

    <div>
        <p><strong>Fecha de Inicio:</strong> {{ $jornada->fecha_inicio }}</p>
        <p><strong>Fecha de Fin:</strong> {{ $jornada->fecha_fin }}</p>
        <p><strong>Tipo:</strong> {{ $jornada->tipo }}</p>
        <p><strong>Hora de Entrada:</strong> {{ $jornada->hora_entrada }}</p>
        <p><strong>Hora de Salida:</strong> {{ $jornada->hora_salida }}</p>
        <p><strong>Inicio de Descanso:</strong> {{ $jornada->inicio_descanso }}</p>
        <p><strong>Fin de Descanso:</strong> {{ $jornada->fin_descanso }}</p>
        <p><strong>Sucursal:</strong> {{ $jornada->sucursal }}</p>
    </div>

    <!-- Aquí puedes agregar el código QR -->
    <div>
        <h4> QR de la Jornada</h4>
        {!! QrCode::size(300)->generate(route('jornada.show', $jornada->id)); !!}
    </div>

    <!-- Botón para escanear el QR y registrar asistencia -->
    <button id="escanearQr" class="btn btn-primary mt-3">Escanear QR y Registrar Asistencia</button>

    <a href="{{ route('jornada.index') }}" class="btn btn-secondary mt-3">Volver al Historial</a>
</div>

<script>
    document.getElementById('escanearQr').addEventListener('click', function() {
        // Obtener datos del usuario almacenados en localStorage
        const usuario = JSON.parse(localStorage.getItem('usuario'));
        const qrData = { jornada_id: {{ $jornada->id }}, fecha: "{{ $jornada->fecha_inicio }}", hora_entrada: "{{ $jornada->hora_entrada }}" }; // Datos del QR que se obtienen de la jornada

        // Verificar si los datos del usuario están presentes
        if (!usuario) {
            console.error('No se encontró información del usuario en localStorage');
            return;
        }

        // Combinar los datos del usuario y los datos del QR
        const payload = { 
            id_usuario: usuario.id,
            ...qrData
        };

        // Enviar los datos al backend utilizando fetch
        fetch('/registrar-asistencia', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir el token CSRF
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => console.log('Respuesta del servidor:', data))
        .catch(error => console.error('Error al registrar asistencia:', error));
    });
</script>
@endsection
