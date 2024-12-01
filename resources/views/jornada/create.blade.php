@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold text-[#004643]">Crear Nueva Jornada</h1>
    <form action="{{ route('jornada.store') }}" method="POST" class="w-full bg-[#f6f4f5] p-6 rounded">
        @csrf

        <div>
            <p class="text-xl font-semibold text-[#001e1d]">Fechas</p>
        </div>
        
        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('fecha_inicio') is-invalid @enderror" 
                       value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="w-1/2 p-2">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('fecha_fin') is-invalid @enderror" 
                       value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="border-2 border-[#6b7d7c] ">
        <br>
        <p class="text-xl font-semibold text-[#001e1d]">Sucursal</p>
        <div>
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" 
                    class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('tipo') is-invalid @enderror" 
                    required>
                <option value="normal" {{ old('tipo') == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="extra" {{ old('tipo') == 'extra' ? 'selected' : '' }}>Extra</option>
            </select>
            @error('tipo')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <input type="text" id="sucursal" name="sucursal" 
                   class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('sucursal') is-invalid @enderror" 
                   value="{{ old('sucursal') }}" required>
            @error('sucursal')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <hr class="border-2 border-[#6b7d7c] ">
        
        <br>
        <p class="text-xl font-semibold text-[#001e1d]">Horas</p>

        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="hora_entrada">Hora de Entrada</label>
                <input type="time" id="hora_entrada" name="hora_entrada" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('hora_entrada') is-invalid @enderror" 
                       value="{{ old('hora_entrada') }}" required>
                @error('hora_entrada')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="w-1/2 p-2">
                <label for="hora_salida">Hora de Salida</label>
                <input type="time" id="hora_salida" name="hora_salida" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('hora_salida') is-invalid @enderror" 
                       value="{{ old('hora_salida') }}" required>
                @error('hora_salida')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="inicio_descanso">Inicio de Descanso</label>
                <input type="time" id="inicio_descanso" name="inicio_descanso" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('inicio_descanso') is-invalid @enderror" 
                       value="{{ old('inicio_descanso') }}">
                @error('inicio_descanso')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="w-1/2 p-2">
                <label for="fin_descanso">Fin de Descanso</label>
                <input type="time" id="fin_descanso" name="fin_descanso" 
                       class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('fin_descanso') is-invalid @enderror" 
                       value="{{ old('fin_descanso') }}">
                @error('fin_descanso')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn bg-[#004643] text-[#fdfcfd] font-semibold">Guardar Jornada</button>
    </form>
</div>
@endsection
