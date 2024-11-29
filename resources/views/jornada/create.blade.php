@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Crear Nueva Jornada</h1>
    <form action="{{ route('jornada.store') }}" method="POST" class="w-full bg-[#f6f4f5] p-6 rounded">
        @csrf

        <div>
            <p class="text-xl font-semibold text-[#001e1d]">Fechas</p>
        </div>
        
        <div>
            
        </div>

        <hr class="border-4 border-[#6b7d7c] ">

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                <option value="normal">Normal</option>
                <option value="extra">Extra</option>
            </select>
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" id="hora_entrada" name="hora_entrada"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>

        <div class="form-group">
            <label for="hora_salida">Hora de Salida</label>
            <input type="time" id="hora_salida" name="hora_salida"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>

        <div class="form-group">
            <label for="inicio_descanso">Inicio de Descanso</label>
            <input type="time" id="inicio_descanso" name="inicio_descanso"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>

        <div class="form-group">
            <label for="fin_descanso">Fin de Descanso</label>
            <input type="time" id="fin_descanso" name="fin_descanso"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <input type="text" id="sucursal" name="sucursal"  class="appearance-none block w-full bg-[#e6edec] text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Jornada</button>
    </form>
</div>
@endsection
