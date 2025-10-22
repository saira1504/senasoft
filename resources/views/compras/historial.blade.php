@extends('layouts.app')

@section('title', 'Historial de Compras - Ticket Friends')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="gradient-text mb-2">
                    <i class="fas fa-shopping-cart me-2"></i>Historial de Compras
                </h2>
                <p class="text-muted">Revisa todas tus compras de boletas</p>
            </div>
            <a href="{{ route('boletas.index') }}" class="btn btn-primary">
                <i class="fas fa-ticket-alt me-1"></i>Ver Boletas Disponibles
            </a>
        </div>

        @if($compras->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Mis Compras ({{ $compras->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Evento</th>
                                    <th>Localidad</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compras as $compra)
                                <tr>
                                    <td>
                                        <small class="text-muted">
                                            {{ $compra->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <strong>{{ $compra->boleta->evento->nombre_evento }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $compra->boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $compra->boleta->localidad->nombre_localidad }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $compra->cantidad_comprada }}</span>
                                    </td>
                                    <td>
                                        <strong>${{ number_format($compra->precio_unitario, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong class="text-success">${{ number_format($compra->total_pagado, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        @if($compra->estado == 'confirmada')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Confirmada
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Cancelada
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('compras.show', $compra) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye me-1"></i>Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No tienes compras registradas</h5>
                <p class="text-muted">Explora los eventos disponibles y compra tus boletas</p>
                <a href="{{ route('boletas.index') }}" class="btn btn-primary">
                    <i class="fas fa-ticket-alt me-1"></i>Ver Boletas Disponibles
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
