@extends('layouts.app')

@section('title', 'Detalles de la Boleta - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-ticket-alt me-2"></i>Boleta: {{ $boleta->evento->nombre_evento }}
                <span class="badge bg-primary ms-2">{{ $boleta->localidad->codigo_localidad }}</span>
            </h2>
            <div>
                <a href="{{ route('boletas.edit', $boleta) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('boletas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información Principal -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información de la Boleta</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Evento</h6>
                                <p class="text-muted">
                                    <strong>{{ $boleta->evento->nombre_evento }}</strong><br>
                                    <small>{{ $boleta->evento->descripcion }}</small>
                                </p>

                                <h6><i class="fas fa-map-marker-alt me-2"></i>Ubicación del Evento</h6>
                                <p class="text-muted">
                                    <i class="fas fa-building me-1"></i>{{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-map-marker-alt me-2"></i>Localidad</h6>
                                <p class="text-muted">
                                    <strong>{{ $boleta->localidad->nombre_localidad }}</strong><br>
                                    <span class="badge bg-primary">{{ $boleta->localidad->codigo_localidad }}</span>
                                </p>

                                <h6><i class="fas fa-dollar-sign me-2"></i>Precio y Disponibilidad</h6>
                                <p class="text-muted">
                                    <strong>Precio:</strong> ${{ number_format($boleta->valor_boleta, 0, ',', '.') }}<br>
                                    <strong>Disponibles:</strong> {{ $boleta->cantidad_disponible }} boletas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información del Evento -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Detalles del Evento</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-clock me-2"></i>Fechas y Horarios</h6>
                                <p class="text-muted">
                                    <strong>Inicio:</strong> {{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}<br>
                                    <strong>Fin:</strong> {{ $boleta->evento->fecha_hora_fin->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-music me-2"></i>Artistas</h6>
                                @if($boleta->evento->artistas->count() > 0)
                                    @foreach($boleta->evento->artistas as $artista)
                                        <span class="badge bg-info me-1">{{ $artista->nombres }} {{ $artista->apellidos }}</span>
                                    @endforeach
                                @else
                                    <p class="text-muted">Sin artistas asignados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12 mb-3">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h3 class="text-success">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</h3>
                                        <p class="text-muted mb-0">Precio por Boleta</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="card border-info">
                                    <div class="card-body">
                                        <h3 class="text-info">{{ $boleta->cantidad_disponible }}</h3>
                                        <p class="text-muted mb-0">Boletas Disponibles</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <h6><i class="fas fa-info-circle me-2"></i>Información Adicional</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-calendar me-2"></i>Creada: {{ $boleta->created_at->format('d/m/Y') }}</li>
                                <li><i class="fas fa-clock me-2"></i>Actualizada: {{ $boleta->updated_at->format('d/m/Y H:i') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
