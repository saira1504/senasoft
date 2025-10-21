@extends('layouts.app')

@section('title', 'Crear Evento - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Crear Nuevo Evento
                </h4>
                <small class="text-muted">RF1: Registro de eventos con código auto-incrementable</small>
            </div>
            <div class="card-body">
                <form action="{{ route('eventos.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_evento" class="form-label">
                                <i class="fas fa-tag me-1"></i>Nombre del Evento *
                            </label>
                            <input type="text" class="form-control @error('nombre_evento') is-invalid @enderror" 
                                   id="nombre_evento" name="nombre_evento" value="{{ old('nombre_evento') }}" required>
                            @error('nombre_evento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="municipio" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Municipio *
                            </label>
                            <input type="text" class="form-control @error('municipio') is-invalid @enderror" 
                                   id="municipio" name="municipio" value="{{ old('municipio') }}" required>
                            @error('municipio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="departamento" class="form-label">
                                <i class="fas fa-building me-1"></i>Departamento *
                            </label>
                            <input type="text" class="form-control @error('departamento') is-invalid @enderror" 
                                   id="departamento" name="departamento" value="{{ old('departamento') }}" required>
                            @error('departamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">
                            <i class="fas fa-align-left me-1"></i>Descripción del Evento *
                        </label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_hora_inicio" class="form-label">
                                <i class="fas fa-play me-1"></i>Fecha y Hora de Inicio *
                            </label>
                            <input type="datetime-local" class="form-control @error('fecha_hora_inicio') is-invalid @enderror" 
                                   id="fecha_hora_inicio" name="fecha_hora_inicio" value="{{ old('fecha_hora_inicio') }}" required>
                            @error('fecha_hora_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_hora_fin" class="form-label">
                                <i class="fas fa-stop me-1"></i>Fecha y Hora de Fin *
                            </label>
                            <input type="datetime-local" class="form-control @error('fecha_hora_fin') is-invalid @enderror" 
                                   id="fecha_hora_fin" name="fecha_hora_fin" value="{{ old('fecha_hora_fin') }}" required>
                            @error('fecha_hora_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-music me-1"></i>Artistas (Opcional)
                        </label>
                        <div class="row">
                            @foreach($artistas as $artista)
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="artistas[]" 
                                           value="{{ $artista->id }}" id="artista_{{ $artista->id }}"
                                           {{ in_array($artista->id, old('artistas', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="artista_{{ $artista->id }}">
                                        <strong>{{ $artista->nombres }} {{ $artista->apellidos }}</strong><br>
                                        <small class="text-muted">
                                            <i class="fas fa-music me-1"></i>{{ $artista->genero_musical }} | 
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $artista->ciudad_natal }}
                                        </small>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($artistas->count() == 0)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No hay artistas registrados. 
                                <a href="{{ route('artistas.create') }}" class="alert-link">Crear artista</a>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Crear Evento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validación de fechas
    document.getElementById('fecha_hora_inicio').addEventListener('change', function() {
        const fechaInicio = new Date(this.value);
        const fechaFinInput = document.getElementById('fecha_hora_fin');
        fechaFinInput.min = this.value;
    });
</script>
@endsection
