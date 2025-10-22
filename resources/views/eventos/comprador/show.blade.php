@extends('layouts.app')

@section('title', $evento->nombre_evento . ' - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="gradient-text mb-2">{{ $evento->nombre_evento }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos</a></li>
                        <li class="breadcrumb-item active">{{ $evento->nombre_evento }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Eventos
                </a>
                <a href="{{ route('boletas.index') }}?evento={{ $evento->id }}" class="btn btn-success">
                    <i class="fas fa-shopping-cart me-1"></i>Comprar Boletas
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información del Evento -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    @if($evento->imagen_evento)
                    <div class="event-detail-image">
                        <img src="{{ asset('storage/' . $evento->imagen_evento) }}" 
                             class="card-img-top" 
                             alt="{{ $evento->nombre_evento }}">
                    </div>
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $evento->nombre_evento }}</h4>
                        <p class="card-text">{{ $evento->descripcion }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Fecha y Hora</h6>
                                <p class="text-muted">
                                    {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-map-marker-alt me-2"></i>Ubicación</h6>
                                <p class="text-muted">
                                    {{ $evento->municipio }}, {{ $evento->departamento }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artistas -->
                @if($evento->artistas->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-music me-2"></i>Artistas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($evento->artistas as $artista)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    @if($artista->imagen_artista)
                                    <img src="{{ asset('storage/' . $artista->imagen_artista) }}" 
                                         class="rounded-circle me-3" 
                                         width="50" height="50" 
                                         alt="{{ $artista->nombre_artista }}">
                                    @else
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $artista->nombre_artista }}</h6>
                                        <small class="text-muted">{{ $artista->genero_musical }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Boletas Disponibles -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Boletas Disponibles</h5>
                    </div>
                    <div class="card-body">
                        @if($evento->boletas->count() > 0)
                            @foreach($evento->boletas as $boleta)
                            <div class="boleta-item mb-3 p-3 border rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">{{ $boleta->localidad->nombre_localidad }}</h6>
                                    <span class="badge bg-primary">{{ $boleta->localidad->codigo_localidad }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Precio:</span>
                                    <strong class="text-success">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Disponibles:</span>
                                    <span class="badge bg-info">{{ $boleta->cantidad_disponible }}</span>
                                </div>
                                @if($boleta->cantidad_disponible > 0)
                                <a href="{{ route('compras.create', $boleta) }}" class="btn btn-success w-100">
                                    <i class="fas fa-shopping-cart me-1"></i>Comprar
                                </a>
                                @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="fas fa-times me-1"></i>Agotado
                                </button>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-ticket-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No hay boletas disponibles para este evento</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Código del evento:</span>
                            <strong>#{{ $evento->id }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Fecha de creación:</span>
                            <small>{{ $evento->created_at->format('d/m/Y') }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total de boletas:</span>
                            <strong>{{ $evento->boletas->sum('cantidad_disponible') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.event-detail-image {
    height: 300px;
    overflow: hidden;
}

.event-detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.boleta-item {
    transition: box-shadow 0.3s ease;
}

.boleta-item:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
