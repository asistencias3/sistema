{{-- Sidebar --}}
<div class="fixed top-0 left-0 h-full w-52 bg-stone-900 text-white p-4 flex flex-col space-y-4">
    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Index')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'users.index')
        @slot('name', 'Usuarios')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Torneos')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Jugadores')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Equipos')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Partidos')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Estadísticas & Reportes')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Clasificación')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Comunicación')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Instalaciones')
    @endcomponent

    @component('_components.boxSidebar ')
        @slot('icon', '')
        @slot('reference', 'index')
        @slot('name', 'Patrocinadores')
    @endcomponent
