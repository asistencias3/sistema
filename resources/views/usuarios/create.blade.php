@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="form-group mb-4">
            <label for="name" class="block font-medium text-lg">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="form-group mb-4">
            <label for="email" class="block font-medium text-lg">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="form-group mb-4">
            <label for="password" class="block font-medium text-lg">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rol --}}
        <div class="form-group mb-4">
            <label for="rol" class="block font-medium text-lg">Rol</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="" disabled selected>Selecciona un rol</option>
                <option value="1">Administración</option>
                <option value="2">Recursos humanos</option>
                <option value="3">Empleado</option>
            </select>
            @error('rol')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón de Guardar --}}
        <button type="submit" class="btn bg-[#004643] text-[#fdfcfd] font-semibold hover:bg-[#023030]">
            Guardar Usuario
        </button>
    </form>
</div>
@endsection
