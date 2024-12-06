@section('sidebar')
@include('layouts._partials.sidebar_admin')
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Inasistencias</h1>
    <div class="list-group">
        @foreach($inasistencias as $inasistencia)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Empleado:</strong> {{ $inasistencia->empleadoSucursal->name }} 
                    <strong>Fecha:</strong> {{ $inasistencia->fecha }}
                </div>
                <button class="btn btn-sm btn-success justify-button" data-id="{{ $inasistencia->id }}">Justificar</button>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('.justify-button').forEach(button => {
        button.addEventListener('click', function() {
            const asistenciaId = this.getAttribute('data-id');

            fetch(`/Administrador/inasistencias/justificar/${asistenciaId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ asistencia_id: asistenciaId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message); // Mensaje de éxito
                    // Actualizamos el texto del botón para indicar que la inasistencia fue justificada
                    this.textContent = 'Justificada';
                    this.disabled = true; // Deshabilitamos el botón después de justificar
                    location.reload(); // Recarga la página
                }
            })
            .catch(error => {
                console.error('Error al justificar la inasistencia:', error);
            });
        });
    });
</script>

@endsection
