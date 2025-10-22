@extends('layouts.app')

@section('title', 'Acceso de Administrador - Ticket Friends')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-danger text-white text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Acceso de Administrador Requerido
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Acceso Restringido</h5>
                        <p class="mb-0">Para crear eventos y boletas necesitas iniciar sesión como administrador.</p>
                        <hr>
                        <p class="mb-0"><strong>Pasos para acceder:</strong></p>
                        <ol class="mb-0">
                            <li>Hacer login como administrador</li>
                            <li>Ir a la sección "Eventos" o "Boletas"</li>
                            <li>Click en el botón "Nuevo Evento" o "Nueva Boleta"</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-crown me-2"></i>Administrador</h5>
                                </div>
                                <div class="card-body">
                                    <h6>Credenciales de Administrador:</h6>
                                    <p><strong>Email:</strong> admin@ticketfriends.com</p>
                                    <p><strong>Contraseña:</strong> admin123</p>
                                    <div class="d-grid">
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión como Admin
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Comprador</h5>
                                </div>
                                <div class="card-body">
                                    <h6>Credenciales de Comprador:</h6>
                                    <p><strong>Email:</strong> saira@gmailcom</p>
                                    <p><strong>Contraseña:</strong> 12345678</p>
                                    <div class="d-grid">
                                        <a href="{{ route('login') }}" class="btn btn-success">
                                            <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión como Comprador
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5><i class="fas fa-info-circle me-2"></i>Funcionalidades por Rol:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">👑 Administrador puede:</h6>
                                <ul>
                                    <li>Crear, editar y eliminar eventos</li>
                                    <li>Crear, editar y eliminar boletas</li>
                                    <li>Gestionar artistas y localidades</li>
                                    <li>Ver todas las estadísticas</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-success">🛒 Comprador puede:</h6>
                                <ul>
                                    <li>Ver eventos disponibles</li>
                                    <li>Ver boletas disponibles</li>
                                    <li>Comprar boletas</li>
                                    <li>Ver historial de compras</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-user-plus me-1"></i>Registrarse
                        </a>
                        <a href="/" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-1"></i>Ir al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
