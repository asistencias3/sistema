<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Gestión')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Tailwind CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Íconos --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Estilos adicionales -->
    <style>
        body {
            background-color: #002826;
            color: #fdfcfd;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fdfcfd;
        }

        .container {
            margin-top: 100px;
        }

        .hero-section {
            background-color: #004643;
            color: #fdfcfd;
            padding: 80px 0;
            text-align: center;
            border-radius: 15px;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #fdfcfd;
        }

        .hero-section p {
            font-size: 1.2rem;
            color: #fdfcfd;
        }

        .btn-primary {
            background-color: #f6f4f5;
            color: #004643;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 10px;
        }

        .btn-primary:hover {
            background-color: #e6edec;
        }

        footer {
            background-color: #002826;
            color: #fdfcfd;
            padding: 20px 0;
            text-align: center;
            margin-top: 60px;
            border-top: 1px solid #fdfcfd;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="container">
        <div class="hero-section">
            <h1>Bienvenido al Sistema de Gestión de Asistencias</h1>
            <p class="pb-6">Gestiona de manera eficiente la asistencia de tu organización, mantén el control y la seguridad en todo momento.</p>
            
            <!-- Botones de acción -->
            <a href="{{ route('register') }}" class="btn-primary">Crear una cuenta</a>
            <a href="{{ route('login') }}" class="btn-primary">Iniciar sesión</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Sistema de Gestión de Asistencias. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
