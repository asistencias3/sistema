@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="mb-4">Reporte de Inasistencias</h1>
    <form id="inasistenciasForm" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="fecha_inicio" class="form-label">Fecha inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="fecha_fin" class="form-label">Fecha fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Buscar inasistencias</button>
            </div>
        </div>
    </form>
    <div id="resultados" class="mt-4">
        <h4>Resultados:</h4>
        <div id="inasistencias-list" class="list-group">

        </div>
    </div>
</div>

<script>
    document.getElementById('inasistenciasForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const resultadosDiv = document.getElementById('inasistencias-list');
        resultadosDiv.innerHTML = ''; 

        fetch("{{ route('inasistencias.post') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                data.forEach(usuario => {
                    const item = document.createElement('div');
                    item.classList.add('list-group-item');
                    item.textContent = `Nombre: ${usuario.name}, Rol: ${usuario.rol}, Email: ${usuario.email}`;
                    resultadosDiv.appendChild(item);
                });
            } else {
                const noResults = document.createElement('div');
                noResults.classList.add('list-group-item', 'text-danger');
                noResults.textContent = 'No se encontraron inasistencias en este periodo.';
                resultadosDiv.appendChild(noResults);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('list-group-item', 'text-danger');
            errorDiv.textContent = 'Hubo un error al buscar las inasistencias.';
            resultadosDiv.appendChild(errorDiv);
        });
    });
</script>
@endsection
