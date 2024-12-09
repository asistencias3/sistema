<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inasistencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .content-container {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .inasistencias-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .inasistencias-table th, .inasistencias-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .inasistencias-table th {
            background-color: #F44336;
            color: white;
        }

        .inasistencias-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .inasistencias-table tr:hover {
            background-color: #ddd;
        }

        .inasistencias-table td {
            font-size: 14px;
            color: #555;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="content-container">
        <div class="header">
            <h1>Reporte de Inasistencias</h1>
        </div>

        <table class="inasistencias-table">
            <thead>
                <tr>
                    <th>ID Empleado</th>
                    <th>Fecha</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inasistencias as $inasistencia)
                    <tr>
                        <td>{{ $inasistencia->id_empleado }}</td>
                        <td>{{ $inasistencia->fecha }}</td>
                        <td>Inasistencia registrada</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por el sistema el {{ now()->format('d-m-Y') }}.</p>
    </div>
</body>
</html>
