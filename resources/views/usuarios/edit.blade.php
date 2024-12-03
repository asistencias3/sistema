@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="form-group mb-4">
            <label for="name" class="block font-medium text-lg">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="form-group mb-4">
            <label for="email" class="block font-medium text-lg">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="form-group mb-4">
            <label for="password" class="block font-medium text-lg">Contraseña (opcional)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Deja en blanco para no cambiar">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rol --}}
        <div class="form-group mb-4">
            <label for="rol" class="block font-medium text-lg">Rol</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="1" {{ $user->rol == 1 ? 'selected' : '' }}>Administración</option>
                <option value="2" {{ $user->rol == 2 ? 'selected' : '' }}>Recursos humanos</option>
                <option value="3" {{ $user->rol == 3 ? 'selected' : '' }}>Empleado</option>
            </select>
            @error('rol')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón de Enviar --}}
        <button type="submit" class="btn bg-[#004643] text-[#fdfcfd] font-semibold hover:bg-[#023030]">
            Actualizar Usuario
        </button>
    </form>
</div>
@endsection
