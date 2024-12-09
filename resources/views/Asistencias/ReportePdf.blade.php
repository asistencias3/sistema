<!-- resources/views/Asistencias/ReportePdf.blade.php -->
<html>
<head>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333333;
        }

        h1, h2 {
            text-align: center;
            color: #004d40; /* Verde oscuro */
            font-size: 24px;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title {
            color: #004d40; /* Verde oscuro */
            font-size: 22px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #004d40; /* Borde verde oscuro */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #004d40; /* Fondo verde oscuro */
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f1f1f1; /* Fondo claro en filas alternas */
        }

        tr:hover {
            background-color: #e0e0e0; /* Fondo al pasar el mouse */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #004d40;
            padding: 5px;
        }

        .footer p {
            margin: 0;
        }

        .details {
            font-size: 14px;
            color: #333333;
        }

        .details p {
            margin: 5px 0;
        }

        .date {
            font-size: 12px;
            color: #004d40;
            text-align: right;
            padding-right: 20px;
        }
    </style>
</head>
<body>

    <!-- Título del Reporte -->
    <div class="header">
        <h1>Reporte de Asistencias</h1>
        <p class="report-title">Rol: <strong>
            @if ($rol == 1)
                Administrador
            @elseif ($rol == 2)
                Recursos H
            @elseif ($rol == 3)
                Empleado
            @else
                No definido
            @endif
        </strong></p>
                   <!--
            tenemos los roles:
            1. Administrador
            2. Recursos H
            3. Empleado
        -->
        <p class="details"><strong>Empleado:</strong> {{ $empleadoId ? $empleadoId : 'Todos' }}</p>
    </div>

    <!-- Fecha de Generación del Reporte (Arriba a la Derecha) -->
    <div class="date">
        Fecha de Generación: {{ date('d/m/Y') }}
    </div>

    <!-- Tabla de Reporte -->
    <table>
        <thead>
            <tr>
                <th>ID Empleado</th>
                <th>Nombre del Empleado</th>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id_empleado }}</td>
                    <td>{{ $asistencia->empleadoSucursal->name }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_entrada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pie de página con Fecha -->
    <div class="footer">
        <p>Página [page_num] de [topage] - Fecha de Generación: {{ date('d/m/Y') }}</p>
    </div>
</body>
</html>
