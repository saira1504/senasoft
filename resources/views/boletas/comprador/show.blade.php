@extends('layouts.app')

@section('title', 'Detalles de Boleta - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="gradient-text mb-2">Detalles de Boleta</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('boletas.index') }}">Boletas</a></li>
                        <li class="breadcrumb-item active">Detalles</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('boletas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Boletas
                </a>
                @if($boleta->cantidad_disponible > 0)
                <a href="{{ route('compras.create', $boleta) }}" class="btn btn-success">
                    <i class="fas fa-shopping-cart me-1"></i>Comprar Ahora
                </a>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Información del Evento -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    @if($boleta->evento->imagen_evento)
                    <div class="boleta-detail-image">
                        <img src="{{ asset('storage/' . $boleta->evento->imagen_evento) }}" 
                             class="card-img-top" 
                             alt="{{ $boleta->evento->nombre_evento }}">
                    </div>
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $boleta->evento->nombre_evento }}</h4>
                        <p class="card-text">{{ $boleta->evento->descripcion }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Fecha y Hora</h6>
                                <p class="text-muted">
                                    {{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-map-marker-alt me-2"></i>Ubicación</h6>
                                <p class="text-muted">
                                    {{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artistas -->
                @if($boleta->evento->artistas->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-music me-2"></i>Artistas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($boleta->evento->artistas as $artista)
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

            <!-- Información de la Boleta -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Información de la Boleta</h5>
                    </div>
                    <div class="card-body">
                        <div class="boleta-info">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">{{ $boleta->localidad->nombre_localidad }}</h6>
                                <span class="badge bg-primary fs-6">{{ $boleta->localidad->codigo_localidad }}</span>
                            </div>
                            
                            <div class="price-display mb-4">
                                <div class="text-center">
                                    <small class="text-muted">Precio por boleta</small>
                                    <h2 class="text-success mb-0">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</h2>
                                </div>
                            </div>

                            <div class="availability-info mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Disponibles:</span>
                                    <span class="badge bg-info fs-6">{{ $boleta->cantidad_disponible }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Estado:</span>
                                    @if($boleta->cantidad_disponible > 0)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Disponible
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>Agotado
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($boleta->cantidad_disponible > 0)
                            <div class="d-grid">
                                <a href="{{ route('compras.create', $boleta) }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>Comprar Boletas
                                </a>
                            </div>
                            @else
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Esta boleta está agotada
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Adicional</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Código de boleta:</span>
                            <strong>#{{ $boleta->id }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Fecha de creación:</span>
                            <small>{{ $boleta->created_at->format('d/m/Y') }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Última actualización:</span>
                            <small>{{ $boleta->updated_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Información del Evento -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-calendar me-2"></i>Información del Evento</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Código del evento:</span>
                            <strong>#{{ $boleta->evento->id }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Fecha del evento:</span>
                            <small>{{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Ubicación:</span>
                            <small>{{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.boleta-detail-image {
    height: 300px;
    overflow: hidden;
}

.boleta-detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.boleta-info {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.price-display {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border: 2px solid #28a745;
}

.availability-info {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
</style>
@endsection
