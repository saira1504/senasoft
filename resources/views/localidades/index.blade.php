@extends('layouts.app')

@section('title', 'Localidades - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-map-marker-alt me-2"></i>Gestión de Localidades</h2>
            <a href="{{ route('localidades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Nueva Localidad
            </a>
        </div>

        <!-- Lista de Localidades -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lista de Localidades ({{ $localidades->count() }} localidades registradas)</h5>
            </div>
            <div class="card-body">
                @if($localidades->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre de la Localidad</th>
                                    <th>Boletas Asociadas</th>
                                    <th>Fecha de Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($localidades as $localidad)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $localidad->codigo_localidad }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $localidad->nombre_localidad }}</strong>
                                    </td>
                                    <td>
                                        @if($localidad->boletas->count() > 0)
                                            <span class="badge bg-success">{{ $localidad->boletas->count() }} boletas</span>
                                        @else
                                            <span class="text-muted">Sin boletas</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>{{ $localidad->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('localidades.show', $localidad) }}" class="btn btn-sm btn-outline-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('localidades.edit', $localidad) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('localidades.destroy', $localidad) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta localidad?')">
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
                        <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay localidades registradas</h5>
                        <p class="text-muted">Registra la primera localidad para comenzar</p>
                        <a href="{{ route('localidades.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Registrar Primera Localidad
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
