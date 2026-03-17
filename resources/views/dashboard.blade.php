@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0">Dashboard</h2>

  <span class="badge bg-primary">
    {{ session('usuario_nombre') }} ({{ session('usuario_rol') }})
  </span>
</div>

{{-- tarjetas resumen --}}
<div class="row g-3 mb-4">
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted">Pasteles</div>
            <div class="fs-3 fw-bold">{{ $totalPasteles ?? 0 }}</div>
          </div>
          <i class="fa-solid fa-cake-candles fs-2"></i>
        </div>
      </div>
    </div>
  </div>

  @if(session('usuario_rol') === 'admin')
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted">Usuarios</div>
            <div class="fs-3 fw-bold">{{ $totalUsuarios ?? 0 }}</div>
          </div>
          <i class="fa-solid fa-users fs-2"></i>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>

{{-- SECCIÓN ADMIN: tabla usuarios --}}
@if(session('usuario_rol') === 'admin')
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="mb-0">Usuarios registrados</h4>

    <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-sm">
      <i class="fa-solid fa-user-plus"></i> Agregar Usuario
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-bordered m-0">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach(($usuarios ?? []) as $u)
              <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->nombre }}</td>
                <td>{{ $u->apellido }}</td>
                <td>{{ $u->telefono }}</td>
                <td>{{ $u->email }}</td>
                <td>
                  <span class="badge {{ $u->rol === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                    {{ $u->rol }}
                  </span>
                </td>
                <td class="text-nowrap">

                  <a href="{{ route('usuarios.edit', $u->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen"></i> Modificar
                  </a>

                  <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar usuario?')">
                      <i class="fa-solid fa-trash"></i> Eliminar
                    </button>
                  </form>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif

{{-- Catálogo (para admin y usuario normal) --}}
<h4 class="mb-2">Catálogo de Pasteles</h4>

<div class="row g-3">
  @forelse(($pasteles ?? []) as $p)
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        @if($p->imagen)
          <img src="{{ $p->imagen }}" class="card-img-top" alt="pastel">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $p->nombre }}</h5>
          <p class="card-text">{{ $p->descripcion }}</p>
          <span class="badge bg-success">${{ number_format($p->precio, 2) }}</span>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12">
      <div class="alert alert-info">Aún no hay pasteles registrados.</div>
    </div>
  @endforelse
</div>

@endsection