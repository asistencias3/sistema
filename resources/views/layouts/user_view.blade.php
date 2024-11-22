<!DOCTYPE html>
<style>
    body{
        background-color: #0e0e0e;
    }
</style>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>

<body class="text-white font-sans">
    <div class="flex">
        @include('layouts._partials.sidebar')
        {{-- Content --}}
        <div class="flex-1 p-10">
            @yield('content')
        </div>

    </div>
   
     
    @yield('scripts')
</body>
</html>
