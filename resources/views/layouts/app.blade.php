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
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .container {
            margin-top: 20px;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="flex">
        {{-- Sidebar --}}
        <div class="flex-1">
            @include('layouts._partials.sidebar')
        </div>

        {{-- Content --}}
        <div class="pt-10 pr-4 sm:ml-64 w-full">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
            <br>
            <!-- Footer -->
            <div class="bottom-0">
                <footer class="text-center mt-4 py-4">
                    <p class="">&copy; {{ date('Y') }} Sistema de Gestión de Asistencias. Todos los derechos
                        reservados.</p>
                </footer>
            </div>
        </div>

    </div>
    <!-- Barra de navegación -->
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Gestión de Asistencias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jornada.index') }}">Jornadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asistencias.index') }}">Asistencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inasistencias.view') }}">Inasistencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('empleado.index') }}">Validar Empleado</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link"
                                style="display: inline; padding: 0; border: none; background: none;">
                                Log out
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav> --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
