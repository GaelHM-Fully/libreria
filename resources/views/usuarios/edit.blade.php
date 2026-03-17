<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>    
</body>
</html>

@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Modificar Usuario</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">

        @csrf
        @method('PUT')

        {{-- NOMBRE --}}
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <div class="input-group">

            <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
            </span>

            <input type="text"
                name="nombre"
                class="form-control"
                value="{{ old('nombre', $usuario->nombre) }}">

            </div>
        </div>

        {{-- APELLIDO --}}
        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <div class="input-group">

                <span class="input-group-text">
                <i class="fa-solid fa-file"></i>
                </span>

                <input type="text"
                name="apellido"
                class="form-control"
                value="{{ old('apellido', $usuario->apellido) }}">

            </div>

        </div>

        {{-- TELEFONO --}}
        <div class="mb-3">
            <label class="form-label">Telefono</label>
            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa-solid fa-phone"></i>
                </span>

                <input type="text"
                    name="telefono"
                    class="form-control"
                    value="{{ old('telefono', $usuario->telefono) }}">

            </div>
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label">email</label>
            <div class="input-group">

                <span class="input-group-text">
                <i class="fa-solid fa-at"></i>
                </span>

                <input type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $usuario->email) }}">

            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">

            <label class="form-label">Contraseña</label>
            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>

                <input type="password"
                    name="contrasena"
                    class="form-control">

            </div>

            <small 
            
                class="text-muted">Dejar vacío si no deseas cambiar la contraseña

            </small>

        </div>

        <button class="btn btn-primary">

            <i class="fa-solid fa-floppy-disk"></i>
            Actualizar

        </button>

        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Volver

        </a>

    </form>

</div>

@endsection