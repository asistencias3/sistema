{{-- Vista para editar una asistencia ya registrada (Solo Administrador) --}}
@extends('layouts.user_view')

@section('title', 'Asistencia')

@section('content')
    <form class="w-full bg-[#f6f4f5] p-6 rounded">
        <div class="flex flex-wrap -mx-3 mb-6">
            @component('_components.labelForm')
                @slot('label_for', 'grid-date')
                @slot('label_content', 'Fecha')
                @slot('input_id', 'grid-date')
                @slot('input_type', 'date')
                @slot('input_placeholder', 'Fecha en que se marca asistencia')
            @endcomponent
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            @component('_components.labelForm')
                @slot('label_for', 'grid-hora-entrada')
                @slot('label_content', 'Hora entrada')
                @slot('input_id', 'grid-hora-entrada')
                @slot('input_type', 'time')
                @slot('input_placeholder', 'Hora en que entró')
            @endcomponent
            @component('_components.labelForm')
                @slot('label_for', 'grid-hora-salida')
                @slot('label_content', 'Hora salida')
                @slot('input_id', 'grid-hora-salida')
                @slot('input_type', 'time')
                @slot('input_placeholder', 'Hora en que entró')
            @endcomponent
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            @component('_components.labelForm')
                @slot('label_for', 'grid-hora-entrada-dos')
                @slot('label_content', 'Hora entrada')
                @slot('input_id', 'grid-hora-entrada-dos')
                @slot('input_type', 'time')
                @slot('input_placeholder', 'Segunda hora en que entró')
            @endcomponent
            @component('_components.labelForm')
                @slot('label_for', 'grid-hora-salida-dos')
                @slot('label_content', 'Hora salida')
                @slot('input_id', 'grid-hora-salida-dos')
                @slot('input_type', 'time')
                @slot('input_placeholder', 'Segunda hora en que entró')
            @endcomponent
        </div>
    </form>
@endsection
