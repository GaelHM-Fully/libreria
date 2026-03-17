@extends('layouts.app')

@section('content')

<div class="container mt-4" style="max-width: 520px;">

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <h2 class="mb-4 text-center">Iniciar Sesión</h2>

            @include('partials.alerts')

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

        </div>
    </div>

</div>

@endsection