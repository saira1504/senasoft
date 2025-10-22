@extends('layouts.app')

@section('title', 'Detalles de Compra - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-receipt me-2"></i>Detalles de Compra
                <span class="badge bg-primary ms-2">#{{ $compra->id }}</span>
            </h2>
            <div>
                <a href="{{ route('compras.historial') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Volver al Historial
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información de la Compra -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información de la Compra</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-hashtag me-2"></i>Número de Compra</h6>
                                <p class="text-muted">#{{ $compra->id }}</p>

                                <h6><i class="fas fa-calendar me-2"></i>Fecha de Compra</h6>
                                <p class="text-muted">{{ $compra->created_at->format('d/m/Y H:i') }}</p>

                                <h6><i class="fas fa-ticket-alt me-2"></i>Cantidad Comprada</h6>
                                <p class="text-muted">{{ $compra->cantidad_comprada }} boleta(s)</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-credit-card me-2"></i>Método de Pago</h6>
                                <p class="text-muted">
                                    @switch($compra->metodo_pago)
                                        @case('efectivo')
                                            <i class="fas fa-money-bill me-1"></i>Efectivo
                                            @break
                                        @case('tarjeta')
                                            <i class="fas fa-credit-card me-1"></i>Tarjeta
                                            @break
                                        @case('transferencia')
                                            <i class="fas fa-university me-1"></i>Transferencia
                                            @break
                                    @endswitch
                                </p>

                                <h6><i class="fas fa-check-circle me-2"></i>Estado</h6>
                                <p class="text-muted">
                                    @if($compra->estado == 'confirmada')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Confirmada
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>Cancelada
                                        </span>
                                    @endif
                                </p>

                                <h6><i class="fas fa-dollar-sign me-2"></i>Total Pagado</h6>
                                <p class="text-success fw-bold fs-5">${{ number_format($compra->total_pagado, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        @if($compra->observaciones)
                        <div class="mt-3">
                            <h6><i class="fas fa-comment me-2"></i>Observaciones</h6>
                            <p class="text-muted">{{ $compra->observaciones }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Información del Evento -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Información del Evento</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $compra->boleta->evento->nombre_evento }}</h6>
                        <p class="card-text">{{ $compra->boleta->evento->descripcion }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    <strong>Fecha:</strong> {{ $compra->boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    <strong>Ubicación:</strong> {{ $compra->boleta->evento->municipio }}, {{ $compra->boleta->evento->departamento }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen de Costos -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Resumen de Costos</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Precio por boleta:</span>
                            <span>${{ number_format($compra->precio_unitario, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Cantidad:</span>
                            <span>{{ $compra->cantidad_comprada }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong class="text-success">${{ number_format($compra->total_pagado, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Información de la Localidad -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Localidad</h5>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="text-primary">{{ $compra->boleta->localidad->nombre_localidad }}</h6>
                        <small class="text-muted">Código: {{ $compra->boleta->localidad->codigo_localidad }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
