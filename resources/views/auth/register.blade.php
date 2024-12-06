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
            <h1 class="pb-2 text-4xl text-center font-bold text-[#fdfcfd]">Bienvenido, crea una cuenta con nosotros</h1>
            
            <form method="POST" action="{{ route('register') }}" class="bg-[#f6f4f5] px-24 py-4 mx-96 rounded">
                @csrf
                <div>
                    <p class="text-xl text-center font-semibold text-[#001e1d] pb-6">Sistema de gestión de asistencias</p>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-[#001e1d] font-semibold">Usuario</label>
                    <input type="text" id="name" name="name" placeholder="Nombre de usuario" 
                           class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                           value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block text-[#001e1d] font-semibold">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico" 
                           class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                           value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-[#001e1d] font-semibold">Contraseña</label>
                    <input type="password" id="password" name="password" 
                           class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                           required autocomplete="new-password">
                    @error('password')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-[#001e1d] font-semibold">Confirma tu contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                           required autocomplete="new-password">
                    @error('password_confirmation')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <label for="rol" class="block text-[#001e1d] font-semibold">Rol</label>
                    <select id="rol" name="rol" class="block mt-1 w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                        <option value="2">Human Resources</option>
                        <option value="3" selected>Employee</option>
                    </select>
                    @error('rol')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full btn bg-[#004643] text-[#fdfcfd] font-semibold mt-4">Registrar usuario</button>

                <p class="mt-4">¿Ya tienes una cuenta con nosotros? <a href="{{ route('login') }}" class="font-bold text-[#003c39] underline">Inicia sesión</a></p>
            </form>

            <!-- Footer -->
            <footer class="pt-4 text-center mt-4">
                <p class="text-[#fdfcfd]">&copy; {{ date('Y') }} Sistema de Gestión de Asistencias. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
