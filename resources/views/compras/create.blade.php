@extends('layouts.app')

@section('title', 'Comprar Boletas - Ticket Friends')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Comprar Boletas
                </h4>
                <small class="text-muted">Completa la información para realizar tu compra</small>
            </div>
            <div class="card-body">
                <!-- Información del Evento -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    <i class="fas fa-calendar me-2"></i>{{ $boleta->evento->nombre_evento }}
                                </h5>
                                <p class="card-text">{{ $boleta->evento->descripcion }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            <strong>Fecha:</strong> {{ $boleta->evento->fecha_hora_inicio->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <strong>Ubicación:</strong> {{ $boleta->evento->municipio }}, {{ $boleta->evento->departamento }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de la Boleta -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $boleta->localidad->nombre_localidad }}
                                </h6>
                                <h4 class="text-primary">${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</h4>
                                <small class="text-muted">Precio por boleta</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title">
                                    <i class="fas fa-ticket-alt me-2"></i>Disponibles
                                </h6>
                                <h4 class="text-success">{{ $boleta->cantidad_disponible }}</h4>
                                <small class="text-muted">Boletas disponibles</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Compra -->
                <form action="{{ route('compras.store', $boleta) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cantidad_comprada" class="form-label">
                                <i class="fas fa-ticket-alt me-1"></i>Cantidad de Boletas *
                            </label>
                            <input type="number" 
                                   class="form-control @error('cantidad_comprada') is-invalid @enderror" 
                                   id="cantidad_comprada" 
                                   name="cantidad_comprada" 
                                   value="{{ old('cantidad_comprada', 1) }}" 
                                   min="1" 
                                   max="{{ $boleta->cantidad_disponible }}" 
                                   required>
                            <div class="form-text">Máximo {{ $boleta->cantidad_disponible }} boletas disponibles</div>
                            @error('cantidad_comprada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="metodo_pago" class="form-label">
                                <i class="fas fa-credit-card me-1"></i>Método de Pago *
                            </label>
                            <select class="form-select @error('metodo_pago') is-invalid @enderror" 
                                    id="metodo_pago" 
                                    name="metodo_pago" 
                                    required>
                                <option value="">Seleccionar método</option>
                                <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta de Crédito/Débito</option>
                                <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia Bancaria</option>
                            </select>
                            @error('metodo_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="observaciones" class="form-label">
                            <i class="fas fa-comment me-1"></i>Observaciones (Opcional)
                        </label>
                        <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                  id="observaciones" 
                                  name="observaciones" 
                                  rows="3" 
                                  placeholder="Cualquier comentario adicional sobre tu compra...">{{ old('observaciones') }}</textarea>
                        @error('observaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Resumen de la Compra -->
                    <div class="card border-success mb-4">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-calculator me-2"></i>Resumen de la Compra
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Precio por boleta:</strong> ${{ number_format($boleta->valor_boleta, 0, ',', '.') }}</p>
                                    <p class="mb-1"><strong>Cantidad:</strong> <span id="cantidad-display">1</span> boleta(s)</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-success mb-0">
                                        <strong>Total: $<span id="total-display">{{ number_format($boleta->valor_boleta, 0, ',', '.') }}</span></strong>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-shopping-cart me-1"></i>Confirmar Compra
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
    // Calcular total dinámicamente
    document.getElementById('cantidad_comprada').addEventListener('input', function() {
        const cantidad = parseInt(this.value) || 0;
        const precio = {{ $boleta->valor_boleta }};
        const total = cantidad * precio;
        
        document.getElementById('cantidad-display').textContent = cantidad;
        document.getElementById('total-display').textContent = total.toLocaleString('es-CO');
    });
</script>
@endsection
