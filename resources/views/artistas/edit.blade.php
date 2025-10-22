@extends('layouts.app')

@section('title', 'Editar Artista - Sistema de Gestión')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Artista: {{ $artista->nombres }} {{ $artista->apellidos }}
                </h4>
                <small class="text-muted">Código: {{ $artista->codigo_artista }}</small>
            </div>
            <div class="card-body">
                <form action="{{ route('artistas.update', $artista) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="codigo_artista" class="form-label">
                                <i class="fas fa-hashtag me-1"></i>Código del Artista *
                            </label>
                            <input type="text" class="form-control @error('codigo_artista') is-invalid @enderror" 
                                   id="codigo_artista" name="codigo_artista" value="{{ old('codigo_artista', $artista->codigo_artista) }}" 
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
                                   id="nombres" name="nombres" value="{{ old('nombres', $artista->nombres) }}" required>
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">
                                <i class="fas fa-user me-1"></i>Apellidos *
                            </label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                   id="apellidos" name="apellidos" value="{{ old('apellidos', $artista->apellidos) }}" required>
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
                                <option value="Salsa" {{ old('genero_musical', $artista->genero_musical) == 'Salsa' ? 'selected' : '' }}>Salsa</option>
                                <option value="Vallenato" {{ old('genero_musical', $artista->genero_musical) == 'Vallenato' ? 'selected' : '' }}>Vallenato</option>
                                <option value="Cumbia" {{ old('genero_musical', $artista->genero_musical) == 'Cumbia' ? 'selected' : '' }}>Cumbia</option>
                                <option value="Reggaeton" {{ old('genero_musical', $artista->genero_musical) == 'Reggaeton' ? 'selected' : '' }}>Reggaeton</option>
                                <option value="Pop" {{ old('genero_musical', $artista->genero_musical) == 'Pop' ? 'selected' : '' }}>Pop</option>
                                <option value="Rock" {{ old('genero_musical', $artista->genero_musical) == 'Rock' ? 'selected' : '' }}>Rock</option>
                                <option value="Merengue" {{ old('genero_musical', $artista->genero_musical) == 'Merengue' ? 'selected' : '' }}>Merengue</option>
                                <option value="Bachata" {{ old('genero_musical', $artista->genero_musical) == 'Bachata' ? 'selected' : '' }}>Bachata</option>
                                <option value="Otro" {{ old('genero_musical', $artista->genero_musical) == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                                   id="ciudad_natal" name="ciudad_natal" value="{{ old('ciudad_natal', $artista->ciudad_natal) }}" 
                                   placeholder="Ej: Bogotá" required>
                            @error('ciudad_natal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imagen_artista" class="form-label">
                            <i class="fas fa-image me-1"></i>Imagen del Artista
                        </label>
                        @if($artista->imagen_artista)
                            <div class="mb-2">
                                <img src="{{ Storage::url($artista->imagen_artista) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 200px;">
                                <div class="form-text">Imagen actual</div>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('imagen_artista') is-invalid @enderror" 
                               id="imagen_artista" name="imagen_artista" accept="image/*">
                        <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                        @error('imagen_artista')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('artistas.show', $artista) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar Artista
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
