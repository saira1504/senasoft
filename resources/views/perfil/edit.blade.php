@extends('layouts.app')

@section('title', 'Editar Perfil - Ticket Friends')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Mi Perfil
                </h4>
                <small class="text-muted">Actualiza tu información personal</small>
            </div>
            <div class="card-body">
                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-1"></i>Nombre Completo *
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i>Correo Electrónico *
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipo_documento" class="form-label">
                                <i class="fas fa-id-card me-1"></i>Tipo de Documento
                            </label>
                            <select class="form-select @error('tipo_documento') is-invalid @enderror" 
                                    id="tipo_documento" 
                                    name="tipo_documento">
                                <option value="">Seleccionar tipo</option>
                                <option value="CC" {{ old('tipo_documento', $user->tipo_documento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                <option value="CE" {{ old('tipo_documento', $user->tipo_documento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                <option value="TI" {{ old('tipo_documento', $user->tipo_documento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                <option value="PA" {{ old('tipo_documento', $user->tipo_documento) == 'PA' ? 'selected' : '' }}>Pasaporte</option>
                            </select>
                            @error('tipo_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">
                        <i class="fas fa-lock me-2"></i>Cambiar Contraseña
                        <small class="text-muted">(Opcional)</small>
                    </h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key me-1"></i>Contraseña Actual *
                            </label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password">
                            <div class="form-text">Requerida solo si deseas cambiar la contraseña</div>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1"></i>Nueva Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password">
                            <div class="form-text">Mínimo 8 caracteres</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-1"></i>Confirmar Nueva Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('perfil.show') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
