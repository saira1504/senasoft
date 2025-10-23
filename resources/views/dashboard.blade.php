@extends('layouts.app')

@section('title', 'Dashboard - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- HERO --}}
        <div class="text-center mb-5">
           <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=local_activity" />

<h1 class="display-4 gradient-text mb-3">
    <span class="material-symbols-outlined align-middle me-2" style="font-size: 45px;">
        
    </span>
    Ticket Friends
</h1>



            @auth
                <p class="text-muted">
                    Bienvenido, {{ Auth::user()->name }}. Disfruta de los mejores eventos con ticket friends,boletas limitadas ¡No te quedes por fuera!.
                </p>
            @else
                
            @endauth
        </div>

        {{-- INVITADOS: Próximos eventos (home público) --}}
        @guest
            <section class="container my-5">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <div>
                        <center>
                        <h3 class="mb-1">
                            Próximos eventos
                        </h3>
                        
                        <p class="text-muted mb-0">Con Ticket Friends, cada evento es una nueva historia. ¡Compra tus boletas y sé parte del momento! Confirma tu boleta nos vemos en el evento🎉</p>
                        </center>
                    </div>
                    
                </div>

                @if(isset($eventos) && $eventos->count())
                    <div class="row g-4">
                        @foreach($eventos as $evento)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                    {{-- Portada / imagen --}}
                                    @php
                                        $img = $evento->imagen_evento
                                            ? Storage::url($evento->imagen_evento)
                                            : ($evento->imagen_url ?? ($evento->portada_url ?? null));
                                    @endphp
                                    @if($img)
                                        <img src="{{ $img }}" class="card-img-top" alt="Portada {{ $evento->nombre_evento }}"
                                             style="height: 180px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                            <i class="fas fa-image fa-2x text-muted"></i>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title mb-1">{{ $evento->nombre_evento }}</h5>

                                        <div class="small text-muted mb-2">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ optional($evento->fecha_hora_inicio)->format('d/m/Y H:i') ?? 'Fecha por confirmar' }}
                                        </div>

                                        @if(isset($evento->municipio) || isset($evento->departamento))
                                            <div class="mb-2">
                                                <span class="badge bg-info-subtle text-dark">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    {{ trim(($evento->municipio ?? '').(isset($evento->departamento) ? ', '.$evento->departamento : ''), ', ') }}
                                                </span>
                                            </div>
                                        @endif

                                        @php
                                            $precioMin = isset($evento->boletas) ? $evento->boletas->min('valor_boleta') : null;
                                        @endphp
                                        @if($precioMin)
                                            <div class="mb-3">
                                                <span class="badge bg-success-subtle text-success fs-6">
                                                    Desde ${{ number_format($precioMin, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @endif

                                        <div class="mt-auto d-flex gap-2">
                                            <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1">
                                                <i class="fas fa-ticket-alt me-1"></i>Comprar
                                            </a>
                                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Aún no hay eventos publicados</h5>
                        <p class="text-muted mb-0">Vuelve pronto para descubrir nuevos eventos.</p>
                    </div>
                @endif
            </section>
        @endguest

        {{-- AUTENTICADOS: tarjetas de estadísticas + acciones + eventos recientes --}}
        @auth

            @if(method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin())
                {{-- Stats para Administradores --}}
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="fas fa-calendar fa-3x text-tertiary-bg"></i></div>
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
                                <div class="mb-3"><i class="fas fa-music fa-3x text-tertiary-bg"></i></div>
                                <h3 class="gradient-text">{{ \App\Models\Artista::count() }}</h3>
                                <p class="text-muted mb-0">Artistas Registrados</p>
                                <a href="{{ route('artistas.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fas fa-eye me-1"></i>Ver Artistas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="fas fa-map-marker-alt fa-3x text-tertiary-bg"></i></div>
                                <h3 class="gradient-text">{{ \App\Models\Localidad::count() }}</h3>
                                <p class="text-muted mb-0">Localidades</p>
                                <a href="{{ route('localidades.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fas fa-eye me-1"></i>Ver Localidades
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="fas fa-ticket-alt fa-3x text-tertiary-bg"></i></div>
                                <h3 class="gradient-text">{{ \App\Models\Boleta::count() }}</h3>
                                <p class="text-muted mb-0">Tipos de Boletas</p>
                                <a href="{{ route('boletas.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fas fa-eye me-1"></i>Ver Boletas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(method_exists(Auth::user(), 'isComprador') && Auth::user()->isComprador())
                {{-- Stats para Compradores --}}
                <div class="row mb-5">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="fas fa-calendar fa-3x text-primary"></i></div>
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
                                <div class="mb-3"><i class="fas fa-ticket-alt fa-3x text-warning"></i></div>
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

            {{-- Acciones rápidas --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-bolt me-2"></i>
                                @if(method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin())
                                    Acciones de Administración
                                @elseif(method_exists(Auth::user(), 'isComprador') && Auth::user()->isComprador())
                                    Acciones de Compra
                                @else
                                    Acciones
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @if(method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin())
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
                                @elseif(method_exists(Auth::user(), 'isComprador') && Auth::user()->isComprador())
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

            {{-- Eventos recientes --}}
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
                                                @php
                                                    $img = $evento->imagen_evento
                                                        ? Storage::url($evento->imagen_evento)
                                                        : ($evento->imagen_url ?? null);
                                                @endphp
                                                @if($img)
                                                    <img src="{{ $img }}" class="card-img-top"
                                                         alt="{{ $evento->nombre_evento }}"
                                                         style="height: 200px; object-fit: cover;">
                                                @endif

                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fas fa-calendar me-2"></i>{{ $evento->nombre_evento }}
                                                    </h6>
                                                    <p class="card-text text-muted small mb-2">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ optional($evento->fecha_hora_inicio)->format('d/m/Y H:i') ?? 'Fecha por confirmar' }}
                                                    </p>
                                                    @if($evento->municipio || $evento->departamento)
                                                        <p class="card-text text-muted small mb-2">
                                                            <i class="fas fa-map-marker-alt me-1"></i>
                                                            {{ trim(($evento->municipio ?? '').(isset($evento->departamento) ? ', '.$evento->departamento : ''), ', ') }}
                                                        </p>
                                                    @endif

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
