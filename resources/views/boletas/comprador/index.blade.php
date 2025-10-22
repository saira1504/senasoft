@extends('layouts.app')

@section('title', 'Boletas Disponibles - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="gradient-text mb-2">
                    <i class="fas fa-ticket-alt me-2"></i>Boletas Disponibles
                </h2>
                <p class="text-muted">Encuentra y compra boletas para tus eventos favoritos</p>
            </div>
            <div>
                <a href="{{ route('compras.historial') }}" class="btn btn-info me-2">
                    <i class="fas fa-shopping-cart me-1"></i>Mis Compras
                </a>
                <a href="{{ route('eventos.index') }}" class="btn btn-primary">
                    <i class="fas fa-calendar me-1"></i>Ver Eventos
                </a>
            </div>
        </div>

        <!-- Lista de Boletas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Boletas Disponibles ({{ $boletas->count() }} boletas)
                </h5>
            </div>
            <div class="card-body">
                @if($boletas->count() > 0)
                    <div class="row g-4">
                        @foreach($boletas as $boleta)
                        <div class="col-lg-6 col-xl-4">
                            <div class="card h-100 boleta-card">
                                @if($boleta->evento->imagen_evento)
                                <div class="boleta-image-container">
                                    <img src="{{ asset('storage/' . $boleta->evento->imagen_evento) }}" 
                                         class="card-img-top boleta-image" 
                                         alt="{{ $boleta->evento->nombre_evento }}">
                                </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $boleta->evento->nombre_evento }}</h5>
                                    <div class="boleta-details mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <span class="badge bg-primary">{{ $boleta->localidad->codigo_localidad }}</span>
                                            <span class="ms-2 text-muted">{{ $boleta->localidad->nombre_localidad }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar text-success me-2"></i>
                                            <small class="text-muted">
                                                {{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                                            <small class="text-muted">
                                                {{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-ticket-alt text-info me-2"></i>
                                            <small class="text-muted">
                                                Disponibles: {{ $boleta->cantidad_disponible }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="price-section mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Precio por boleta:</span>
                                            <h4 class="text-success mb-0">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-outline-primary flex-fill">
                                            <i class="fas fa-eye me-1"></i>Ver Detalles
                                        </a>
                                        @if($boleta->cantidad_disponible > 0)
                                        <a href="{{ route('compras.create', $boleta) }}" class="btn btn-success flex-fill">
                                            <i class="fas fa-shopping-cart me-1"></i>Comprar
                                        </a>
                                        @else
                                        <button class="btn btn-secondary flex-fill" disabled>
                                            <i class="fas fa-times me-1"></i>Agotado
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay boletas disponibles</h5>
                        <p class="text-muted">No se encontraron boletas disponibles en este momento</p>
                        <a href="{{ route('eventos.index') }}" class="btn btn-primary">
                            <i class="fas fa-calendar me-1"></i>Ver Eventos Disponibles
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.boleta-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.boleta-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.boleta-image-container {
    height: 200px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

.boleta-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.boleta-card:hover .boleta-image {
    transform: scale(1.05);
}

.boleta-details {
    border-top: 1px solid #eee;
    padding-top: 15px;
}

.price-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
</style>
@endsection
