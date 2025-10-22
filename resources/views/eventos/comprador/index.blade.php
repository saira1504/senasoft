@extends('layouts.app')

@section('title', 'Eventos Disponibles - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="gradient-text mb-2">
                    <i class="fas fa-calendar me-2"></i>Eventos Disponibles
                </h2>
                <p class="text-muted">Explora los eventos disponibles y encuentra el perfecto para ti</p>
            </div>
            <a href="{{ route('compras.historial') }}" class="btn btn-info">
                <i class="fas fa-shopping-cart me-1"></i>Mis Compras
            </a>
        </div>

        <!-- Filtros para buscar eventos -->
        <div class="card mb-5 glass-effect">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Buscar Eventos</h5>
                <small class="opacity-75">Encuentra eventos específicos usando los filtros</small>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('eventos.index') }}" class="row g-4">
                    <div class="col-md-3">
                        <label for="fecha" class="form-label fw-bold">
                            <i class="fas fa-calendar-day me-1"></i>Fecha del Evento
                        </label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ request('fecha') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="municipio" class="form-label fw-bold">
                            <i class="fas fa-map-marker-alt me-1"></i>Municipio
                        </label>
                        <input type="text" class="form-control" id="municipio" name="municipio" 
                               placeholder="Buscar por municipio" value="{{ request('municipio') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="departamento" class="form-label fw-bold">
                            <i class="fas fa-building me-1"></i>Departamento
                        </label>
                        <input type="text" class="form-control" id="departamento" name="departamento" 
                               placeholder="Buscar por departamento" value="{{ request('departamento') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Buscar
                        </button>
                        <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Limpiar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Eventos -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Eventos Disponibles ({{ $eventos->count() }} eventos)
                </h5>
            </div>
            <div class="card-body">
                @if($eventos->count() > 0)
                    <div class="row g-4">
                        @foreach($eventos as $evento)
                        <div class="col-lg-6 col-xl-4">
                            <div class="card h-100 event-card">
                                @if($evento->imagen_evento)
                                <div class="event-image-container">
                                    <img src="{{ asset('storage/' . $evento->imagen_evento) }}" 
                                         class="card-img-top event-image" 
                                         alt="{{ $evento->nombre_evento }}">
                                </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit($evento->descripcion, 100) }}
                                    </p>
                                    <div class="event-details mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <small class="text-muted">
                                                {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                                            <small class="text-muted">
                                                {{ $evento->municipio }}, {{ $evento->departamento }}
                                            </small>
                                        </div>
                                        @if($evento->artistas->count() > 0)
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-music text-warning me-2"></i>
                                            <small class="text-muted">
                                                {{ $evento->artistas->pluck('nombre_artista')->join(', ') }}
                                            </small>
                                        </div>
                                        @endif
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-ticket-alt text-info me-2"></i>
                                            <small class="text-muted">
                                                {{ $evento->boletas->count() }} tipo(s) de boleta
                                            </small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('eventos.show', $evento) }}" class="btn btn-outline-primary flex-fill">
                                            <i class="fas fa-eye me-1"></i>Ver Detalles
                                        </a>
                                        <a href="{{ route('boletas.index') }}?evento={{ $evento->id }}" class="btn btn-success flex-fill">
                                            <i class="fas fa-shopping-cart me-1"></i>Comprar Boletas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay eventos disponibles</h5>
                        <p class="text-muted">No se encontraron eventos con los filtros aplicados</p>
                        <a href="{{ route('eventos.index') }}" class="btn btn-primary">
                            <i class="fas fa-refresh me-1"></i>Ver Todos los Eventos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.event-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.event-image-container {
    height: 200px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

.event-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .event-image {
    transform: scale(1.05);
}

.event-details {
    border-top: 1px solid #eee;
    padding-top: 15px;
}
</style>
@endsection
