<!DOCTYPE html>
<style>
    body{
        background-color: #ffffff;
    }
</style>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @yield('styles')
</head>

<body class="font-sans">

    <div class="flex">
        {{-- Sidebar --}}
        <div class="flex-none">
            @include('layouts._partials.sidebar')
        </div>
        
        {{-- Content --}}
        <div class="pt-10 pr-4 sm:ml-64 w-full">
            @yield('content')
        </div>

    </div>
   
     
    @yield('scripts')
</body>
</html>
