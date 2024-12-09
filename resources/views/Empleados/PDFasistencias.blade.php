<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencias</title>
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

        .asistencias-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .asistencias-table th, .asistencias-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .asistencias-table th {
            background-color: #4CAF50;
            color: white;
        }

        .asistencias-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .asistencias-table tr:hover {
            background-color: #ddd;
        }

        .asistencias-table td {
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
            <h1>Reporte de Asistencias</h1>
        </div>

        <table class="asistencias-table">
            <thead>
                <tr>
                    <th>ID Empleado</th>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $asistencia->id_empleado }}</td>
                        <td>{{ $asistencia->fecha }}</td>
                        <td>{{ $asistencia->hora_entrada }}</td>
                        <td>{{ $asistencia->hora_salida }}</td>
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
