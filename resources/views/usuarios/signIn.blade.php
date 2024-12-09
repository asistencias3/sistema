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
        {{-- Content --}}
        <div class="pt-3 pr-4 w-full">
            <h1 class="pb-2 text-4xl text-center font-bold text-[#fdfcfd]">Bienvenido, crea una cuenta con nosotros
            </h1>
            <form action="#" method="POST" class="bg-[#f6f4f5] px-24 py-4 mx-96 rounded">
                @csrf

                <div>
                    <p class="text-xl text-center font-semibold text-[#001e1d] pb-6">Sistema de gestión de asitencias</p>
                </div>

                <label for="name">Usuario</label>
                <input type="text" id="name" name="name" placeholder="Nombre de usuario"
                    class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    required>

                <label for="email">Correo</label>
                <input type="text" id="email" name="email" placeholder="Correo electrónico"
                    class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    required>

                <label for="password-confirm">Confirma tu contraseña</label>
                <input type="password" id="password-confirm" name="password-confirm"
                    class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    required>
                <button type="submit" class="w-full btn bg-[#004643] text-[#fdfcfd] font-semibold">Registrar usuario</button>
                <p>¿Ya tienes una cuenta con nosotros? <a href="{{route('usuario.loginPrueba')}}" class="font-bold text-[#003c39] underline underline-offset-2">Inicia sesión</a></p>
            </form>
            <!-- Footer -->
            <div class="bottom-0">
                <footer class="pt-4 text-center">
                    <p class="text-[#fdfcfd]">&copy; {{ date('Y') }} Sistema de Gestión de Asistencias. Todos los derechos
                        reservados.</p>
                </footer>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
