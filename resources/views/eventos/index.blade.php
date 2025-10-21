@extends('layouts.app')

@section('title', 'Eventos - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-calendar me-2"></i>Gestión de Eventos</h2>
            <a href="{{ route('eventos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Nuevo Evento
            </a>
        </div>

        <!-- Filtros para RF5: Consulta por fecha, municipio o departamento -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros de Búsqueda</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('eventos.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha del Evento</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ request('fecha') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="municipio" class="form-label">Municipio</label>
                        <input type="text" class="form-control" id="municipio" name="municipio" 
                               placeholder="Buscar por municipio" value="{{ request('municipio') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" 
                               placeholder="Buscar por departamento" value="{{ request('departamento') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary me-2">
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
                <h5 class="mb-0">Lista de Eventos ({{ $eventos->count() }} eventos encontrados)</h5>
            </div>
            <div class="card-body">
                @if($eventos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre del Evento</th>
                                    <th>Descripción</th>
                                    <th>Fecha y Hora</th>
                                    <th>Ubicación</th>
                                    <th>Artistas</th>
                                    <th>Boletas Disponibles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventos as $evento)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $evento->id }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $evento->nombre_evento }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ Str::limit($evento->descripcion, 50) }}</small>
                                    </td>
                                    <td>
                                        <small>
                                            <i class="fas fa-calendar me-1"></i>{{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}<br>
                                            <i class="fas fa-clock me-1"></i>{{ $evento->fecha_hora_fin->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <small>
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $evento->municipio }}<br>
                                            <i class="fas fa-building me-1"></i>{{ $evento->departamento }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($evento->artistas->count() > 0)
                                            @foreach($evento->artistas->take(2) as $artista)
                                                <span class="badge bg-info me-1">{{ $artista->nombres }}</span>
                                            @endforeach
                                            @if($evento->artistas->count() > 2)
                                                <span class="badge bg-secondary">+{{ $evento->artistas->count() - 2 }}</span>
                                            @endif
                                        @else
                                            <small class="text-muted">Sin artistas</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($evento->boletas->count() > 0)
                                            @foreach($evento->boletas->take(2) as $boleta)
                                                <small class="d-block">
                                                    <strong>{{ $boleta->localidad->nombre_localidad }}:</strong> 
                                                    {{ $boleta->cantidad_disponible }} boletas
                                                </small>
                                            @endforeach
                                            @if($evento->boletas->count() > 2)
                                                <small class="text-muted">+{{ $evento->boletas->count() - 2 }} más</small>
                                            @endif
                                        @else
                                            <small class="text-muted">Sin boletas</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('eventos.show', $evento) }}" class="btn btn-sm btn-outline-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este evento?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No se encontraron eventos</h5>
                        <p class="text-muted">Crea tu primer evento para comenzar</p>
                        <a href="{{ route('eventos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Crear Primer Evento
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
