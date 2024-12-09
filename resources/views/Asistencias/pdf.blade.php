<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencias</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .report-info {
            text-align: right;
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        table thead {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        table tbody tr:hover {
            background-color: #d9f7d6;
        }

        .empty-message {
            text-align: center;
            font-size: 16px;
            color: #888;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-height: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <!-- Coloca tu logo aquí -->
            <img src="{{asset('assets/img/logo.png')}}" alt="Logo de la empresa">
        </div>

        <div class="report-info">
            <p><strong>Fecha del reporte:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>

        <h1>Reporte de Asistencias</h1>

        <table>
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
                @forelse ($asistencias as $asistencia)
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
                @empty
                    <tr>
                        <td colspan="5" class="empty-message">No se encontraron asistencias registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Reporte generado automáticamente el {{ now()->format('d/m/Y') }}.</p>
        </div>
    </div>
</body>
</html>
