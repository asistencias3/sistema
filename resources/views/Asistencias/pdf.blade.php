<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de asistencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #000;
            margin-bottom: 20px;
        }

        .report-info {
            text-align: right;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #ffffff;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #000;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #e0e0e0; 
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="report-info">
        <p>Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
        <h1>Reporte de Asistencias</h1>
        <div class="subtitle">Listado detallado de las asistencias registradas</div>
    </div>

    <table class="striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id }}</td>
                    <td>{{ $asistencia->empleadoSucursal->name }}</td>
                    <td>
                        @switch($asistencia->empleadoSucursal->rol)
                            @case(1) Administrador @break
                            @case(2) Recursos Humanos @break
                            @case(3) Empleado @break
                            @default Desconocido
                        @endswitch
                    </td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Reporte generado el {{ now()->format('d/m/Y') }}.
    </div>
</body>
</html>
