@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="mb-0">Catálogo de Pasteles</h2>

  @if(session('usuario_id'))
    <span class="badge bg-primary">
      {{ session('usuario_nombre') }} ({{ session('usuario_rol') }})
    </span>
  @endif
</div>

<div class="row g-3">
  @forelse($pasteles as $p)
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