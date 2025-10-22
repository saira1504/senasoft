@extends('layouts.app')

@section('title', 'Mi Perfil - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-user me-2"></i>Mi Perfil
            </h2>
            <div>
                <a href="{{ route('perfil.edit') }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Editar Perfil
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información Personal -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Personal</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-user me-2"></i>Nombre Completo</h6>
                                <p class="text-muted">{{ $user->name }}</p>

                                <h6><i class="fas fa-envelope me-2"></i>Correo Electrónico</h6>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-id-card me-2"></i>Tipo de Documento</h6>
                                <p class="text-muted">
                                    @if($user->tipo_documento)
                                        @switch($user->tipo_documento)
                                            @case('CC')
                                                <i class="fas fa-id-card me-1"></i>Cédula de Ciudadanía
                                                @break
                                            @case('CE')
                                                <i class="fas fa-id-card me-1"></i>Cédula de Extranjería
                                                @break
                                            @case('TI')
                                                <i class="fas fa-id-card me-1"></i>Tarjeta de Identidad
                                                @break
                                            @case('PA')
                                                <i class="fas fa-id-card me-1"></i>Pasaporte
                                                @break
                                            @default
                                                {{ $user->tipo_documento }}
                                        @endswitch
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </p>

                                <h6><i class="fas fa-calendar me-2"></i>Miembro desde</h6>
                                <p class="text-muted">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas de Compras -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas de Compras</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h3 class="text-primary">{{ $user->compras->count() }}</h3>
                                        <p class="text-muted mb-0">Compras Realizadas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h3 class="text-success">{{ $user->compras->sum('cantidad_comprada') }}</h3>
                                        <p class="text-muted mb-0">Boletas Compradas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-warning">
                                    <div class="card-body">
                                        <h3 class="text-warning">${{ number_format($user->compras->sum('total_pagado'), 0, ',', '.') }}</h3>
                                        <p class="text-muted mb-0">Total Gastado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('perfil.edit') }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Editar Perfil
                            </a>
                            <a href="{{ route('compras.historial') }}" class="btn btn-info">
                                <i class="fas fa-shopping-cart me-2"></i>Historial de Compras
                            </a>
                            <a href="{{ route('eventos.admin.index') }}" class="btn btn-primary">
                                <i class="fas fa-calendar me-2"></i>Ver Eventos
                            </a>
                            <a href="{{ route('boletas.index') }}" class="btn btn-success">
                                <i class="fas fa-ticket-alt me-2"></i>Comprar Boletas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Información de la Cuenta -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Información de la Cuenta</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Rol:</span>
                            @if($user->isAdmin())
                                <span class="badge bg-danger">Administrador</span>
                            @elseif($user->isComprador())
                                <span class="badge bg-success">Comprador</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Estado:</span>
                            <span class="badge bg-success">Activo</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Última actualización:</span>
                            <small class="text-muted">{{ $user->updated_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
