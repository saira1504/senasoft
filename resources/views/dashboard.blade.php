@extends('layouts.app')

@section('title', 'Dashboard - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Hero Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 gradient-text mb-3">
                <i class="fas fa-ticket-alt me-3"></i>Ticket Friends
            </h1>
            <p class="lead text-muted mb-4">Sistema de Gestión de Eventos y Boletas</p>
            @auth
                <p class="text-muted">Bienvenido, {{ Auth::user()->name }}! Administra eventos, artistas, localidades y boletas de manera eficiente</p>
            @else
                <p class="text-muted">Inicia sesión para acceder al sistema de gestión de eventos</p>
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Registrarse
                    </a>
                </div>
            @endauth
        </div>

        @auth
        @if(Auth::user()->isAdmin())
        <!-- Stats Cards para Administradores -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-calendar fa-3x text-primary"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Evento::count() }}</h3>
                        <p class="text-muted mb-0">Eventos Activos</p>
                        <a href="{{ route('eventos.admin.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fas fa-eye me-1"></i>Ver Eventos
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-music fa-3x text-info"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Artista::count() }}</h3>
                        <p class="text-muted mb-0">Artistas Registrados</p>
                        <a href="{{ route('artistas.index') }}" class="btn btn-outline-info btn-sm mt-2">
                            <i class="fas fa-eye me-1"></i>Ver Artistas
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-map-marker-alt fa-3x text-success"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Localidad::count() }}</h3>
                        <p class="text-muted mb-0">Localidades</p>
                        <a href="{{ route('localidades.index') }}" class="btn btn-outline-success btn-sm mt-2">
                            <i class="fas fa-eye me-1"></i>Ver Localidades
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-ticket-alt fa-3x text-warning"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Boleta::count() }}</h3>
                        <p class="text-muted mb-0">Tipos de Boletas</p>
                        <a href="{{ route('boletas.index') }}" class="btn btn-outline-warning btn-sm mt-2">
                            <i class="fas fa-eye me-1"></i>Ver Boletas
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->isComprador())
        <!-- Stats Cards para Compradores -->
        <div class="row mb-5">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-calendar fa-3x text-primary"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Evento::count() }}</h3>
                        <p class="text-muted mb-0">Eventos Disponibles</p>
                        <a href="{{ route('eventos.admin.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fas fa-eye me-1"></i>Ver Eventos
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-ticket-alt fa-3x text-warning"></i>
                        </div>
                        <h3 class="gradient-text">{{ \App\Models\Boleta::count() }}</h3>
                        <p class="text-muted mb-0">Boletas Disponibles</p>
                        <a href="{{ route('boletas.index') }}" class="btn btn-outline-warning btn-sm mt-2">
                            <i class="fas fa-shopping-cart me-1"></i>Comprar Boletas
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>
                            @if(Auth::user()->isAdmin())
                                Acciones de Administración
                            @elseif(Auth::user()->isComprador())
                                Acciones de Compra
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @if(Auth::user()->isAdmin())
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('eventos.admin.create') }}" class="btn btn-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                    <span class="fw-bold">Nuevo Evento</span>
                                    <small class="opacity-75">Crear un nuevo evento</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('artistas.create') }}" class="btn btn-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-user-plus fa-2x mb-2"></i>
                                    <span class="fw-bold">Nuevo Artista</span>
                                    <small class="opacity-75">Registrar artista</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('localidades.create') }}" class="btn btn-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-map-marker-plus fa-2x mb-2"></i>
                                    <span class="fw-bold">Nueva Localidad</span>
                                    <small class="opacity-75">Agregar localidad</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('boletas.create') }}" class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-ticket-alt fa-2x mb-2"></i>
                                    <span class="fw-bold">Nueva Boleta</span>
                                    <small class="opacity-75">Crear tipo de boleta</small>
                                </a>
                            </div>
                            @elseif(Auth::user()->isComprador())
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('eventos.admin.index') }}" class="btn btn-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-calendar fa-2x mb-2"></i>
                                    <span class="fw-bold">Ver Eventos</span>
                                    <small class="opacity-75">Explorar eventos disponibles</small>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('boletas.index') }}" class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                    <span class="fw-bold">Comprar Boletas</span>
                                    <small class="opacity-75">Adquirir boletas para eventos</small>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('compras.historial') }}" class="btn btn-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                    <i class="fas fa-receipt fa-2x mb-2"></i>
                                    <span class="fw-bold">Mis Compras</span>
                                    <small class="opacity-75">Ver historial de compras</small>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Events -->
        @if(\App\Models\Evento::count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Eventos Recientes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach(\App\Models\Evento::with(['artistas', 'boletas'])->latest()->take(3)->get() as $evento)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    @if($evento->imagen_evento)
                                        <img src="{{ Storage::url($evento->imagen_evento) }}" 
                                             class="card-img-top" 
                                             alt="{{ $evento->nombre_evento }}"
                                             style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-calendar me-2"></i>{{ $evento->nombre_evento }}
                                        </h6>
                                        <p class="card-text text-muted small">
                                            <i class="fas fa-clock me-1"></i>{{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }}<br>
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $evento->municipio }}, {{ $evento->departamento }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-music me-1"></i>{{ $evento->artistas->count() }} artistas
                                            </small>
                                            <a href="{{ route('eventos.admin.show', $evento) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>Ver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endauth
    </div>
</div>
@endsection
