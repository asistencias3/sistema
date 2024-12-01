@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="mb-4">Reporte de Inasistencias</h1>
    <a href="{{ route('inasistencias.filtroPdf') }}" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Reporte
        </a>
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
                    item.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    
                
                    const userInfo = document.createElement('div');
                    userInfo.innerHTML = `
                        <strong>Nombre:</strong> ${usuario.name}, 
                        <strong>Rol:</strong> ${usuario.rol}, 
                        <strong>Email:</strong> ${usuario.email}
                    `;

                    
                    const totalInfo = document.createElement('div');
                    totalInfo.innerHTML = `
                        <span class="badge bg-primary rounded-pill">
                            ${usuario.total_inasistencias} inasistencias
                        </span>
                    `;

                   
                    const fechasDiv = document.createElement('div');
                    fechasDiv.style.marginTop = '10px';
                    fechasDiv.style.display = 'none'; 
                    fechasDiv.innerHTML = `
                        <strong>Fechas de inasistencias:</strong>
                        <ul>
                            ${usuario.fechas_inasistencias.map(fecha => `<li>${fecha}</li>`).join('')}
                        </ul>
                    `;

                    
                    const button = document.createElement('button');
                    button.textContent = 'Ver fechas';
                    button.classList.add('btn', 'btn-link', 'ms-3');
                    button.style.textDecoration = 'none';
                    button.addEventListener('click', function () {
                        if (fechasDiv.style.display === 'none') {
                            fechasDiv.style.display = 'block';
                            button.textContent = 'Ocultar fechas';
                        } else {
                            fechasDiv.style.display = 'none';
                            button.textContent = 'Ver fechas';
                        }
                    });

                   
                    item.appendChild(userInfo);
                    item.appendChild(totalInfo);
                    item.appendChild(button);
                    item.appendChild(fechasDiv);

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
