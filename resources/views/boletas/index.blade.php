@extends('layouts.app')

@section('title', 'Boletas - Sistema de Gestión')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-ticket-alt me-2"></i>Gestión de Boletas</h2>
            <a href="{{ route('boletas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Nueva Boleta
            </a>
        </div>

        <!-- Lista de Boletas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lista de Boletas ({{ $boletas->count() }} boletas registradas)</h5>
            </div>
            <div class="card-body">
                @if($boletas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Evento</th>
                                    <th>Localidad</th>
                                    <th>Precio</th>
                                    <th>Disponibles</th>
                                    <th>Fecha del Evento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boletas as $boleta)
                                <tr>
                                    <td>
                                        <strong>{{ $boleta->evento->nombre_evento }}</strong><br>
                                        <small class="text-muted">{{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $boleta->localidad->codigo_localidad }}</span><br>
                                        <small class="text-muted">{{ $boleta->localidad->nombre_localidad }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-success fs-6">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $boleta->cantidad_disponible }} boletas</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>{{ $boleta->evento->fecha_hora_inicio->format('d/m/Y') }}<br>
                                            <i class="fas fa-clock me-1"></i>{{ $boleta->evento->fecha_hora_inicio->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-sm btn-outline-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('boletas.edit', $boleta) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('boletas.destroy', $boleta) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta boleta?')">
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
                        <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay boletas registradas</h5>
                        <p class="text-muted">Crea la primera boleta para comenzar</p>
                        <a href="{{ route('boletas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Crear Primera Boleta
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
