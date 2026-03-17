<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pastelería</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c24842f28a.js" crossorigin="anonymous"></script>

  <style>
    .app-wrap { min-height: 100vh; background: #f7f7f7; }
    .topbar { background:#fff; border-bottom:1px solid #e6e6e6; }
    .sidebar {
      width: 260px; background:#fff; border-right:1px solid #e6e6e6;
      position: sticky; top: 56px; height: calc(100vh - 56px); overflow-y:auto;
    }
    .sidebar .nav-link { color:#222; border-radius:10px; padding:.6rem .8rem; }
    .sidebar .nav-link:hover { background:#f1f1f1; }
    .sidebar .nav-link.active { background:#0d6efd; color:#fff; }
    .content { width: 100%; padding: 24px; }
  </style>
</head>

<body>

<nav class="navbar topbar px-3">
  <div class="d-flex align-items-center gap-2">
    <i class="fa-solid fa-cake-candles"></i>
    <strong>SweetSlice</strong>
  </div>

  <div class="d-flex align-items-center gap-2">
    @if(session('usuario_id'))
      <span class="badge bg-primary">
        {{ session('usuario_nombre') }} ({{ session('usuario_rol') }})
      </span>

      <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button class="btn btn-outline-danger btn-sm">
          <i class="fa-solid fa-right-from-bracket"></i> Salir
        </button>
      </form>
    @else
      <a href="{{ route('login') }}" class="btn btn-success btn-sm">
        <i class="fa-solid fa-right-to-bracket"></i> Entrar
      </a>
    @endif
  </div>
</nav>

<div class="app-wrap d-flex">

  @if(session('usuario_id'))
    <aside class="sidebar p-3">
      <div class="nav flex-column gap-1">

        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           href="{{ route('dashboard') }}">
          <i class="fa-solid fa-gauge me-2"></i> Dashboard
        </a>

        <a class="nav-link {{ request()->routeIs('pasteles.index') || request()->routeIs('pasteles.list') ? 'active' : '' }}"
           href="{{ route('pasteles.index') }}">
          <i class="fa-solid fa-store me-2"></i> Catálogo
        </a>

        @if(session('usuario_rol') === 'admin')
          <hr class="my-2">
          <div class="text-muted small px-2">Administración</div>

          <a class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"
             href="{{ route('usuarios.index') }}">
            <i class="fa-solid fa-users me-2"></i> Usuarios (CRUD)
          </a>

          <a class="nav-link"
             href="{{ route('usuarios.create') }}">
            <i class="fa-solid fa-user-plus me-2"></i> Agregar Usuario
          </a>
        @endif

      </div>
    </aside>
  @endif

  <main class="content">
    @yield('content')
  </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>