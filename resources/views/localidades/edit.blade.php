@extends('layouts.app')

@section('title', 'Editar Localidad - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Localidad: {{ $localidad->nombre_localidad }}
                </h4>
                <small class="text-muted">Código: {{ $localidad->codigo_localidad }}</small>
            </div>
            <div class="card-body">
                <form action="{{ route('localidades.update', $localidad) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="codigo_localidad" class="form-label">
                                <i class="fas fa-hashtag me-1"></i>Código de la Localidad *
                            </label>
                            <input type="text" class="form-control @error('codigo_localidad') is-invalid @enderror" 
                                   id="codigo_localidad" name="codigo_localidad" value="{{ old('codigo_localidad', $localidad->codigo_localidad) }}" 
                                   placeholder="Ej: LOC001" required>
                            <div class="form-text">Código único para identificar la localidad</div>
                            @error('codigo_localidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nombre_localidad" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Nombre de la Localidad *
                            </label>
                            <input type="text" class="form-control @error('nombre_localidad') is-invalid @enderror" 
                                   id="nombre_localidad" name="nombre_localidad" value="{{ old('nombre_localidad', $localidad->nombre_localidad) }}" 
                                   placeholder="Ej: Palco VIP" required>
                            @error('nombre_localidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Advertencia:</strong> Cambiar el código o nombre de la localidad puede afectar las boletas ya creadas.
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('localidades.show', $localidad) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar Localidad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
