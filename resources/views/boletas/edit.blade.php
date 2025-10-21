@extends('layouts.app')

@section('title', 'Editar Boleta - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Boleta: {{ $boleta->evento->nombre_evento }}
                </h4>
                <small class="text-muted">Localidad: {{ $boleta->localidad->nombre_localidad }}</small>
            </div>
            <div class="card-body">
                <form action="{{ route('boletas.update', $boleta) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="evento_id" class="form-label">
                                <i class="fas fa-calendar me-1"></i>Evento *
                            </label>
                            <select class="form-select @error('evento_id') is-invalid @enderror" 
                                    id="evento_id" name="evento_id" required>
                                <option value="">Seleccionar evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}" {{ old('evento_id', $boleta->evento_id) == $evento->id ? 'selected' : '' }}>
                                        {{ $evento->nombre_evento }} - {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('evento_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="localidad_id" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Localidad *
                            </label>
                            <select class="form-select @error('localidad_id') is-invalid @enderror" 
                                    id="localidad_id" name="localidad_id" required>
                                <option value="">Seleccionar localidad</option>
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->id }}" {{ old('localidad_id', $boleta->localidad_id) == $localidad->id ? 'selected' : '' }}>
                                        {{ $localidad->nombre_localidad }} ({{ $localidad->codigo_localidad }})
                                    </option>
                                @endforeach
                            </select>
                            @error('localidad_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valor_boleta" class="form-label">
                                <i class="fas fa-dollar-sign me-1"></i>Valor de la Boleta *
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('valor_boleta') is-invalid @enderror" 
                                       id="valor_boleta" name="valor_boleta" value="{{ old('valor_boleta', $boleta->valor_boleta) }}" 
                                       min="0" step="0.01" placeholder="0.00" required>
                            </div>
                            @error('valor_boleta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cantidad_disponible" class="form-label">
                                <i class="fas fa-ticket-alt me-1"></i>Cantidad de Boletas Disponibles *
                            </label>
                            <input type="number" class="form-control @error('cantidad_disponible') is-invalid @enderror" 
                                   id="cantidad_disponible" name="cantidad_disponible" value="{{ old('cantidad_disponible', $boleta->cantidad_disponible) }}" 
                                   min="1" placeholder="Ej: 100" required>
                            @error('cantidad_disponible')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Información:</strong> Al cambiar el evento o localidad, se verificará que no exista otra boleta con la misma combinación.
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar Boleta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
