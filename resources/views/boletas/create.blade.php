@extends('layouts.app')

@section('title', 'Crear Boleta - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Crear Nueva Boleta
                </h4>
                <small class="text-muted">RF2: Módulo de boletería con selección de evento, localidad, valor y cantidad</small>
            </div>
            <div class="card-body">
                <form action="{{ route('boletas.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="evento_id" class="form-label">
                                <i class="fas fa-calendar me-1"></i>Evento *
                            </label>
                            <select class="form-select @error('evento_id') is-invalid @enderror" 
                                    id="evento_id" name="evento_id" required>
                                <option value="">Seleccionar evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}" {{ old('evento_id') == $evento->id ? 'selected' : '' }}>
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
                                    <option value="{{ $localidad->id }}" {{ old('localidad_id') == $localidad->id ? 'selected' : '' }}>
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
                                       id="valor_boleta" name="valor_boleta" value="{{ old('valor_boleta') }}" 
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
                                   id="cantidad_disponible" name="cantidad_disponible" value="{{ old('cantidad_disponible') }}" 
                                   min="1" placeholder="Ej: 100" required>
                            @error('cantidad_disponible')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if($eventos->count() == 0 || $localidades->count() == 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Advertencia:</strong> 
                            @if($eventos->count() == 0)
                                No hay eventos registrados. 
                                <a href="{{ route('eventos.create') }}" class="alert-link">Crear evento</a>
                            @endif
                            @if($localidades->count() == 0)
                                @if($eventos->count() == 0) <br> @endif
                                No hay localidades registradas. 
                                <a href="{{ route('localidades.create') }}" class="alert-link">Crear localidad</a>
                            @endif
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('boletas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary" 
                                {{ $eventos->count() == 0 || $localidades->count() == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-save me-1"></i>Crear Boleta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
