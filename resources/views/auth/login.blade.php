<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Íconos -->
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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg-[#003230] flex justify-center items-center h-screen">
            <div class="h-screen lg:block">
                <img src="{{ asset('assets/img/login_image.jpg') }}" alt="imagen_login" class="object-cover w-full h-full">
            </div>
            <div class="lg:p-36 md:p-52 sm:20 p-3 w-full lg:w-1/2">
                <div>
                    <p class="text-4xl font-semibold text-[#fdfcfd]">Bienvenido,</p>
                    <p class="text-4xl font-semibold text-[#fdfcfd] pb-2">Inicia sesión con tu cuenta.</p>
                </div>
                <div>
                    <p class="text-xl text-[#f6f4f5] mb-4">¡Es un placer tenerte de vuelta con nosotros!</p>
                </div>

                <!-- Aquí va el formulario de login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="text-[#f2f0f1]">Correo</label>
                        <input type="text" id="email" name="email" placeholder="Ingresa tu correo electrónico"
                            class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            required value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="text-[#f2f0f1]">Contraseña</label>
                        <input type="password" id="password" name="password"
                            class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="mt-3 w-full btn bg-[#2e6765] text-[#fdfcfd] font-semibold hover:text-[#fdfcfd] bg-[#004643]">Iniciar sesión</button>

                    <p class="text-[#fdfcfd]">¿No tienes una cuenta con nosotros? <a href="{{ route('register') }}"
                        class="font-bold text-[#91afae] underline underline-offset-2">Regístrate</a></p>
                </form>
            </div>
        </div>
    </body>
</html>
