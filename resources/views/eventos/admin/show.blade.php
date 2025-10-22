@extends('layouts.app')

@section('title', 'Detalles del Evento - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-calendar me-2"></i>{{ $evento->nombre_evento }}
                <span class="badge bg-primary ms-2">Código: {{ $evento->id }}</span>
            </h2>
            <div>
                <a href="{{ route('eventos.admin.edit', $evento) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('eventos.admin.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información Principal -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información del Evento</h5>
                    </div>
                    <div class="card-body">
                        @if($evento->imagen_evento)
                            <div class="text-center mb-4">
                                <img src="{{ Storage::url($evento->imagen_evento) }}" 
                                     alt="{{ $evento->nombre_evento }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 300px; object-fit: cover;">
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-tag me-2"></i>Nombre del Evento</h6>
                                <p class="text-muted">{{ $evento->nombre_evento }}</p>

                                <h6><i class="fas fa-align-left me-2"></i>Descripción</h6>
                                <p class="text-muted">{{ $evento->descripcion }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Fechas y Horarios</h6>
                                <p class="text-muted">
                                    <strong>Inicio:</strong> {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}<br>
                                    <strong>Fin:</strong> {{ $evento->fecha_hora_fin->format('d/m/Y H:i') }}
                                </p>

                                <h6><i class="fas fa-map-marker-alt me-2"></i>Ubicación</h6>
                                <p class="text-muted">
                                    <strong>Municipio:</strong> {{ $evento->municipio }}<br>
                                    <strong>Departamento:</strong> {{ $evento->departamento }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artistas -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-music me-2"></i>Artistas</h5>
                    </div>
                    <div class="card-body">
                        @if($evento->artistas->count() > 0)
                            <div class="row">
                                @foreach($evento->artistas as $artista)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <i class="fas fa-user me-2"></i>{{ $artista->nombres }} {{ $artista->apellidos }}
                                            </h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-music me-1"></i><strong>Género:</strong> {{ $artista->genero_musical }}<br>
                                                    <i class="fas fa-map-marker-alt me-1"></i><strong>Ciudad Natal:</strong> {{ $artista->ciudad_natal }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-music fa-2x text-muted mb-2"></i>
                                <p class="text-muted">No hay artistas asignados a este evento</p>
                                <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Asignar Artistas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
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
                            <div class="card border mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ $boleta->localidad->nombre_localidad }}
                                    </h6>
                                    <p class="card-text">
                                        <strong>Precio:</strong> ${{ number_format($boleta->valor_boleta, 0, ',', '.') }}<br>
                                        <strong>Disponibles:</strong> {{ $boleta->cantidad_disponible }} boletas
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">
                                            <i class="fas fa-hashtag me-1"></i>Código: {{ $boleta->localidad->codigo_localidad }}
                                        </small>
                                        <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('boletas.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Agregar Boletas
                                </a>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-ticket-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted">No hay boletas disponibles para este evento</p>
                                <a href="{{ route('boletas.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Crear Boletas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
