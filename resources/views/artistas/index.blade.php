@extends('layouts.app')

@section('title', 'Artistas - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="gradient-text mb-2"><i class="fas fa-music me-2"></i>Gestión de Artistas</h2>
                <p class="text-muted">Administra el catálogo de artistas y sus géneros musicales</p>
            </div>
            <a href="{{ route('artistas.create') }}" class="btn btn-primary pulse-animation">
                <i class="fas fa-plus me-1"></i>Nuevo Artista
            </a>
        </div>

        <!-- Lista de Artistas -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Lista de Artistas</h5>
                        <small class="opacity-75">{{ $artistas->count() }} artistas registrados</small>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge bg-info">{{ $artistas->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($artistas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre Completo</th>
                                    <th>Género Musical</th>
                                    <th>Ciudad Natal</th>
                                    <th>Eventos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($artistas as $artista)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $artista->codigo_artista }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $artista->nombres }} {{ $artista->apellidos }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $artista->genero_musical }}</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $artista->ciudad_natal }}
                                    </td>
                                    <td>
                                        @if($artista->eventos->count() > 0)
                                            <span class="badge bg-success">{{ $artista->eventos->count() }} eventos</span>
                                        @else
                                            <span class="text-muted">Sin eventos</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('artistas.show', $artista) }}" class="btn btn-sm btn-outline-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('artistas.edit', $artista) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('artistas.destroy', $artista) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este artista?')">
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
                        <i class="fas fa-music fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay artistas registrados</h5>
                        <p class="text-muted">Registra el primer artista para comenzar</p>
                        <a href="{{ route('artistas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Registrar Primer Artista
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
