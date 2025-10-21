@extends('layouts.app')

@section('title', 'Crear Artista - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Registrar Nuevo Artista
                </h4>
                <small class="text-muted">RF4: Módulo de artistas con código, nombres, género musical y ciudad natal</small>
            </div>
            <div class="card-body">
                <form action="{{ route('artistas.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="codigo_artista" class="form-label">
                                <i class="fas fa-hashtag me-1"></i>Código del Artista *
                            </label>
                            <input type="text" class="form-control @error('codigo_artista') is-invalid @enderror" 
                                   id="codigo_artista" name="codigo_artista" value="{{ old('codigo_artista') }}" 
                                   placeholder="Ej: ART001" required>
                            <div class="form-text">Código único para identificar al artista</div>
                            @error('codigo_artista')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombres" class="form-label">
                                <i class="fas fa-user me-1"></i>Nombres *
                            </label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                   id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">
                                <i class="fas fa-user me-1"></i>Apellidos *
                            </label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                   id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                            @error('apellidos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="genero_musical" class="form-label">
                                <i class="fas fa-music me-1"></i>Género Musical *
                            </label>
                            <select class="form-select @error('genero_musical') is-invalid @enderror" 
                                    id="genero_musical" name="genero_musical" required>
                                <option value="">Seleccionar género</option>
                                <option value="Salsa" {{ old('genero_musical') == 'Salsa' ? 'selected' : '' }}>Salsa</option>
                                <option value="Vallenato" {{ old('genero_musical') == 'Vallenato' ? 'selected' : '' }}>Vallenato</option>
                                <option value="Cumbia" {{ old('genero_musical') == 'Cumbia' ? 'selected' : '' }}>Cumbia</option>
                                <option value="Reggaeton" {{ old('genero_musical') == 'Reggaeton' ? 'selected' : '' }}>Reggaeton</option>
                                <option value="Pop" {{ old('genero_musical') == 'Pop' ? 'selected' : '' }}>Pop</option>
                                <option value="Rock" {{ old('genero_musical') == 'Rock' ? 'selected' : '' }}>Rock</option>
                                <option value="Merengue" {{ old('genero_musical') == 'Merengue' ? 'selected' : '' }}>Merengue</option>
                                <option value="Bachata" {{ old('genero_musical') == 'Bachata' ? 'selected' : '' }}>Bachata</option>
                                <option value="Otro" {{ old('genero_musical') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero_musical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="ciudad_natal" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Ciudad Natal *
                            </label>
                            <input type="text" class="form-control @error('ciudad_natal') is-invalid @enderror" 
                                   id="ciudad_natal" name="ciudad_natal" value="{{ old('ciudad_natal') }}" 
                                   placeholder="Ej: Bogotá" required>
                            @error('ciudad_natal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('artistas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Registrar Artista
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
