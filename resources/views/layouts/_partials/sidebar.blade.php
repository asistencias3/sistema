<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Creepster&family=Kumbh+Sans:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<div class="sidebarC fixed top-0 left-0 h-full w-60 bg-lime-700 text-white p-2 flex flex-col items-center space-y-4" style="background: #004643; font-family: 'Kumbh Sans', sans-serif;">

    <div class="">
        <!-- Imagen centrada -->
        <div class="flex justify-center items-center mt-5">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-16 h-16 mt-2 mb-5">
        </div>

        <p class="mb-9">Gestor de Asitencia</p>
    </div>

    <hr class="border-0 h-px bg-white my-4 w-full"> <!-- Línea horizontal con Tailwind -->

    <!-- Links del sidebar -->
    <div class="w-full h-5 p-4">
        @component('_components.boxSidebar ')
            @slot('icon')
                <ion-icon name="home-outline"></ion-icon>
            @endslot
            @slot('reference', 'index')
            @slot('name', 'Inicio')
        @endcomponent

        @component('_components.boxSidebar ')
            @slot('icon')
                <ion-icon name="lock-open-outline"></ion-icon>
            @endslot
            @slot('reference', 'permisos.permisos')
            @slot('name', 'Permisos')
        @endcomponent

        @component('_components.boxSidebar ')
            @slot('icon')
                <ion-icon name="person-outline"></ion-icon>
            @endslot
            @slot('reference', 'usuarios.usuarios')
            @slot('name', 'Trabajadores')
        @endcomponent

        @component('_components.boxSidebar ')
            @slot('icon')
                <ion-icon name="checkbox-outline"></ion-icon>
            @endslot
            @slot('reference', 'asistencia.asistencia')
            @slot('name', 'Asistencia')
        @endcomponent
        
        @component('_components.boxSidebar ')
            @slot('icon')
                <ion-icon name="document-text-outline"></ion-icon>
            @endslot
            @slot('reference', 'informes.informes')
            @slot('name', 'Hacer Informe')
        @endcomponent
    </div>

</div>