<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ticket Friends - Sistema de Gestión de Eventos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #FF6B35;
            --secondary-orange: #FF8C42;
            --accent-orange: #FFB366;
            --dark-orange: #E55A2B;
            --light-orange: #FFD4B3;
            --accent-blue: #3B82F6;
            --accent-teal: #06B6D4;
            --accent-pink: #EC4899;
            --white: #FFFFFF;
            --light-gray: #F8FAFC;
            --medium-gray: #E2E8F0;
            --dark-gray: #1E293B;
            --text-gray: #64748B;
            --success-green: #10B981;
            --warning-orange: #F59E0B;
            --danger-red: #EF4444;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #FFFFFF;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 107, 53, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 140, 66, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 179, 102, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%) !important;
            box-shadow: 0 4px 20px rgba(255, 107, 53, 0.3);
            border: none;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--white) !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: var(--light-orange) !important;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.75rem 1.2rem !important;
            border-radius: 12px;
            margin: 0 0.3rem;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: var(--white) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--light-orange), var(--accent-orange));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            margin: 2rem auto;
            padding: 2.5rem;
            animation: slideInUp 0.8s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            overflow: hidden;
            background: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            color: var(--white);
            border: none;
            padding: 1.8rem;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .card:hover .card-header::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 107, 53, 0.6);
            background: linear-gradient(135deg, var(--dark-orange) 0%, var(--primary-orange) 100%);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-orange) 0%, #F97316 100%);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(245, 158, 11, 0.6);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.6);
        }

        .btn-info {
            background: linear-gradient(135deg, var(--accent-teal) 0%, var(--accent-blue) 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }

        .btn-info:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(6, 182, 212, 0.6);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-orange);
            color: var(--primary-orange);
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: rgba(255, 107, 53, 0.1);
        }

        .btn-outline-primary:hover {
            background: var(--primary-orange);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
        }

        .table {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            background: var(--white);
        }

        .table th {
            background: linear-gradient(135deg, var(--light-gray) 0%, #F1F5F9 100%);
            border: none;
            color: var(--dark-gray);
            font-weight: 600;
            padding: 1.2rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 1.2rem;
            border: none;
            border-bottom: 1px solid var(--medium-gray);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(255, 140, 66, 0.05) 100%);
            transform: scale(1.01);
        }

        .badge {
            border-radius: 25px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%) !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, var(--accent-teal) 0%, var(--accent-blue) 100%) !important;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%) !important;
        }

        .form-control, .form-select {
            border: 2px solid var(--medium-gray);
            border-radius: 12px;
            padding: 0.8rem 1.2rem;
            transition: all 0.3s ease;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.3rem rgba(255, 107, 53, 0.25);
            background: var(--white);
        }

        .alert {
            border: none;
            border-radius: 16px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: var(--danger-red);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
            color: var(--accent-teal);
            border: 1px solid rgba(6, 182, 212, 0.2);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
            color: var(--warning-orange);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        footer {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            color: var(--white);
            text-align: center;
            padding: 2.5rem 0;
            margin-top: 4rem;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -4px 20px rgba(255, 107, 53, 0.3);
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(255, 140, 66, 0.1));
            animation: float 8s ease-in-out infinite;
        }

        .floating-elements::before {
            top: 10%;
            left: 5%;
            animation-delay: -2s;
        }

        .floating-elements::after {
            top: 50%;
            right: 5%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1); 
            }
            50% { 
                transform: translateY(-30px) rotate(180deg) scale(1.1); 
            }
        }

        .pulse-animation {
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>
    <!-- Elementos flotantes de fondo -->
    <div class="floating-elements"></div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-ticket-alt me-2"></i>Ticket Friends
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('eventos.admin.index') }}">
                            <i class="fas fa-calendar me-1"></i>Eventos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('boletas.index') }}">
                            <i class="fas fa-ticket-alt me-1"></i>Boletas
                        </a>
                    </li>
                    @if(Auth::user()->isComprador())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('compras.historial') }}">
                            <i class="fas fa-shopping-cart me-1"></i>Mis Compras
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artistas.index') }}">
                            <i class="fas fa-music me-1"></i>Artistas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('localidades.index') }}">
                            <i class="fas fa-map-marker-alt me-1"></i>Localidades
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            @if(Auth::user()->isAdmin())
                                <span class="badge bg-danger ms-1">Admin</span>
                            @elseif(Auth::user()->isComprador())
                                <span class="badge bg-success ms-1">Comprador</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                <small class="text-muted">
                                    @if(Auth::user()->isAdmin())
                                        <i class="fas fa-crown me-1"></i>Administrador
                                    @elseif(Auth::user()->isComprador())
                                        <i class="fas fa-shopping-cart me-1"></i>Comprador
                                    @endif
                                </small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('perfil.show') }}">
                                    <i class="fas fa-user me-1"></i>Mi Perfil
                                </a>
                            </li>
                            @if(Auth::user()->isComprador())
                            <li>
                                <a class="dropdown-item" href="{{ route('compras.historial') }}">
                                    <i class="fas fa-shopping-cart me-1"></i>Mis Compras
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Registrarse
                        </a>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container text-center">
            <p class="mb-0">
                <i class="fas fa-graduation-cap me-1"></i>
                Sistema de Gestión de Eventos - SENA 2025
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
