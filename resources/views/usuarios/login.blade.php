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
    <div>
        {{-- Content --}}
        <div class="bg-[#003230] flex justify-center items-center h-screen">

            <div class="h-screen lg:block">
                <img src="{{ asset('assets/img/login_image.jpg') }}" alt="imagen_login"
                    class="object-cover w-full h-full">
            </div>
            <div class="lg:p-36 md:p-52 sm:20 p-3 w-full lg:w-1/2">
                <div>
                    <p class="text-4xl font-semibold text-[#fdfcfd]">Bienvenido,</p>
                    <p class="text-4xl font-semibold text-[#fdfcfd] pb-2">inicia sesión con tu cuenta.</p>
                </div>
                <div>
                    <p class="text-xl text-[#f6f4f5] mb-4">¡Es un placer tenerte de vuelta
                        con nosotros!</p>
                </div>
                <form action="#" method="POST">
                    @csrf


                    <div>
                        <label for="email" class="text-[#f2f0f1]">Correo</label>
                        <input type="text" id="email" name="email" placeholder="Ingresa tu correo electrónico"
                            class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            required>
                    </div>
                    <div>
                        <label for="password" class="text-[#f2f0f1]">Contraseña</label>
                        <input type="password" id="password" name="password"
                            class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            required>
                    </div>
                    <a href="{{ route('usuario.loginPrueba') }}"
                        class="font-bold text-[#e6edec] underline underline-offset-2 pb-2">¿Olvidaste tu contraseña?</a>
                    <button type="submit" class="mt-3 w-full btn bg-[#2e6765] text-[#fdfcfd] font-semibold hover:text-[#fdfcfd] bg-[#004643]">Iniciar
                        sesión</button>
                    <p class="text-[#fdfcfd]">¿No tienes una cuenta con nosotros? <a href="{{ route('usuario.signIn') }}"
                            class="font-bold text-[#91afae] underline underline-offset-2">Regístrate</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
