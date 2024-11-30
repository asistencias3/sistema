<!-- resources/views/Asistencias/Filtro_Pdf_Asistencias.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Filtrar Asistencias</h1>

    <form action="{{ route('asistencias.generarPdf') }}" method="GET">
        <!-- Filtro de Roles -->
    <label for="rol">Rol:</label>
    <select id="rol" name="rol">
        <option value="">Todos</option>
        @foreach ($roles as $id => $nombre)
            <option value="{{ $id }}">{{ $nombre }}</option>
        @endforeach
    </select>

    <!-- Filtro de Empleados (cargar dinámicamente) -->
    <label for="id_empleado">Empleado:</label>
    <select id="id_empleado" name="id_empleado" disabled>
        <option value="">Selecciona un empleado</option>
    </select>

    <button type="submit">Generar PDF</button>
    </form>
</div>

<script>
    document.getElementById('rol').addEventListener('change', function () {
        const rol = this.value;
        const empleadoSelect = document.getElementById('id_empleado');
        
        // Deshabilitar el select de empleados mientras se cargan los datos
        empleadoSelect.disabled = true;
        empleadoSelect.innerHTML = '<option value="">Cargando...</option>';

        if (rol) {
            fetch("{{ route('get.empleados') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ rol: rol })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la red');
                }
                return response.json();
            })
            .then(data => {
                empleadoSelect.innerHTML = '<option value="">Selecciona un empleado</option>';
                data.forEach(empleado => {
                    const option = document.createElement('option');
                    option.value = empleado.id;
                    option.textContent = empleado.name;
                    empleadoSelect.appendChild(option);
                });
                empleadoSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                empleadoSelect.innerHTML = '<option value="">Error al cargar</option>';
                empleadoSelect.disabled = false;
            });
        } else {
            empleadoSelect.innerHTML = '<option value="">Selecciona un empleado</option>';
            empleadoSelect.disabled = true;
        }
    });
</script>

@endsection
