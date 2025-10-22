@extends('layouts.app')

@section('title', 'Detalles del Artista - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-music me-2"></i>{{ $artista->nombres }} {{ $artista->apellidos }}
                <span class="badge bg-primary ms-2">{{ $artista->codigo_artista }}</span>
            </h2>
            <div>
                <a href="{{ route('artistas.edit', $artista) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('artistas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información Principal -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información del Artista</h5>
                    </div>
                    <div class="card-body">
                        @if($artista->imagen_artista)
                            <div class="text-center mb-4">
                                <img src="{{ Storage::url($artista->imagen_artista) }}" 
                                     alt="{{ $artista->nombres }} {{ $artista->apellidos }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 300px; object-fit: cover;">
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-hashtag me-2"></i>Código del Artista</h6>
                                <p class="text-muted">{{ $artista->codigo_artista }}</p>

                                <h6><i class="fas fa-user me-2"></i>Nombre Completo</h6>
                                <p class="text-muted">{{ $artista->nombres }} {{ $artista->apellidos }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-music me-2"></i>Género Musical</h6>
                                <p class="text-muted">
                                    <span class="badge bg-info fs-6">{{ $artista->genero_musical }}</span>
                                </p>

                                <h6><i class="fas fa-map-marker-alt me-2"></i>Ciudad Natal</h6>
                                <p class="text-muted">{{ $artista->ciudad_natal }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eventos del Artista -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Eventos del Artista</h5>
                    </div>
                    <div class="card-body">
                        @if($artista->eventos->count() > 0)
                            <div class="row">
                                @foreach($artista->eventos as $evento)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <i class="fas fa-calendar me-2"></i>{{ $evento->nombre_evento }}
                                            </h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}<br>
                                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $evento->municipio }}, {{ $evento->departamento }}
                                                </small>
                                            </p>
                                            <a href="{{ route('eventos.admin.show', $evento) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>Ver Evento
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Este artista no tiene eventos asignados</p>
                                <a href="{{ route('eventos.admin.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Crear Evento
                                </a>
                            </div>
                        @endif
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
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h3 class="text-primary">{{ $artista->eventos->count() }}</h3>
                                        <p class="text-muted mb-0">Eventos Participando</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <h6><i class="fas fa-info-circle me-2"></i>Información Adicional</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-calendar me-2"></i>Registrado: {{ $artista->created_at->format('d/m/Y') }}</li>
                                <li><i class="fas fa-clock me-2"></i>Última actualización: {{ $artista->updated_at->format('d/m/Y H:i') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
