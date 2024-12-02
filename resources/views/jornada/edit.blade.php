@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Editar Jornada</h1>
    <form action="{{ route('jornada.update', $jornada->id) }}" method="POST" class="w-full bg-[#f6f4f5] p-6 rounded">
        @csrf
        @method('PUT')

        <div>
            <p class="text-xl font-semibold text-[#001e1d]">Fechas</p>
        </div>
        
        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $jornada->fecha_inicio }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            </div>
    
            <div class="w-1/2 p-2">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ $jornada->fecha_fin }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            </div>
        </div>

        <hr class="border-2 border-[#6b7d7c] ">
        <br>
        <p class="text-xl font-semibold text-[#001e1d]">Sucursal</p>
        <div>
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                <option value="normal" {{ $jornada->tipo == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="extra" {{ $jornada->tipo == 'extra' ? 'selected' : '' }}>Extra</option>
            </select>
            @error('tipo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <input type="text" id="sucursal" name="sucursal" value="{{ $jornada->sucursal }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>

        <hr class="border-2 border-[#6b7d7c] ">
        
        <br>
        <p class="text-xl font-semibold text-[#001e1d]">Horas</p>

        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="hora_entrada">Hora de Entrada</label>
                <input type="time" id="hora_entrada" name="hora_entrada" value="{{ $jornada->hora_entrada }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            </div>
    
            <div class="w-1/2 p-2">
                <label for="hora_salida">Hora de Salida</label>
                <input type="time" id="hora_salida" name="hora_salida" value="{{ $jornada->hora_salida }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
            </div>
        </div>

        <div class="flex">
            <div class="w-1/2 p-2">
                <label for="inicio_descanso">Inicio de Descanso</label>
                <input type="time" id="inicio_descanso" name="inicio_descanso" value="{{ $jornada->inicio_descanso }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </div>
    
            <div class="w-1/2 p-2">
                <label for="fin_descanso">Fin de Descanso</label>
                <input type="time" id="fin_descanso" name="fin_descanso" value="{{ $jornada->fin_descanso }}" class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </div>
        </div>

        <button type="submit" class="btn bg-[#004643] text-[#fdfcfd] font-semibold">Actualizar Jornada</button>
    </form>
</div>
@endsection
