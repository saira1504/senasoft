@extends('layouts.app')

@section('title', 'Detalles de la Localidad - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-map-marker-alt me-2"></i>{{ $localidad->nombre_localidad }}
                <span class="badge bg-primary ms-2">{{ $localidad->codigo_localidad }}</span>
            </h2>
            <div>
                <a href="{{ route('localidades.edit', $localidad) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('localidades.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información Principal -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información de la Localidad</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-hashtag me-2"></i>Código de la Localidad</h6>
                                <p class="text-muted">{{ $localidad->codigo_localidad }}</p>

                                <h6><i class="fas fa-map-marker-alt me-2"></i>Nombre de la Localidad</h6>
                                <p class="text-muted">{{ $localidad->nombre_localidad }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Fecha de Registro</h6>
                                <p class="text-muted">{{ $localidad->created_at->format('d/m/Y H:i') }}</p>

                                <h6><i class="fas fa-clock me-2"></i>Última Actualización</h6>
                                <p class="text-muted">{{ $localidad->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boletas de la Localidad -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Boletas de esta Localidad</h5>
                    </div>
                    <div class="card-body">
                        @if($localidad->boletas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Evento</th>
                                            <th>Precio</th>
                                            <th>Disponibles</th>
                                            <th>Fecha del Evento</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($localidad->boletas as $boleta)
                                        <tr>
                                            <td>
                                                <strong>{{ $boleta->evento->nombre_evento }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $boleta->cantidad_disponible }} boletas</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                                </small>
                                            </td>
                                            <td>
                                                <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Ver
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-ticket-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Esta localidad no tiene boletas asociadas</p>
                                <a href="{{ route('boletas.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Crear Boletas
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
                                        <h3 class="text-primary">{{ $localidad->boletas->count() }}</h3>
                                        <p class="text-muted mb-0">Boletas Asociadas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($localidad->boletas->count() > 0)
                        <div class="mt-3">
                            <h6><i class="fas fa-info-circle me-2"></i>Resumen de Boletas</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-ticket-alt me-2"></i>Total de boletas: {{ $localidad->boletas->sum('cantidad_disponible') }}</li>
                                <li><i class="fas fa-dollar-sign me-2"></i>Precio promedio: ${{ number_format($localidad->boletas->avg('valor_boleta'), 0, ',', '.') }}</li>
                                <li><i class="fas fa-calendar me-2"></i>Eventos: {{ $localidad->boletas->count() }}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
