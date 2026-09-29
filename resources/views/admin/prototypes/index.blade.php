<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Prototipos | Semáforo TT1</title>
    
    <!-- BOOTSTRAP 5 Y ÍCONOS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f7f6; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background-color: #243447; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid #3b5a9a;
            min-height: 85px; 
        }

        .table-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            background-color: #ffffff;
            overflow: hidden; 
        }

        .table > thead {
            background-color: #f8f9fa;
            color: #495057;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px;
            border-bottom: 2px solid #e9ecef;
        }
        .table td {
            padding: 15px;
            vertical-align: middle;
            color: #243447;
        }
        
        .badge-inteligente { background-color: #e0ebff; color: #3b5a9a; border: 1px solid #3b5a9a; }
        .badge-fijo { background-color: #e2e3e5; color: #383d41; border: 1px solid #6c757d; }
        .badge-mantenimiento { background-color: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        
        .btn-action {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-right: 5px;
            transition: all 0.2s;
        }
        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- CABECERA -->
    <nav class="navbar navbar-dark navbar-custom py-3 py-md-4">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="text-white">
                    <h1 class="fw-bold mb-0 fs-2">Mis Prototipos</h1>
                </div>
                <div>
                    <!-- Botón "Volver" dinámico -->
                    <a href="{{ auth()->check() && auth()->user()->role === 'user' ? route('user.dashboard') : route('admin.dashboard') }}" class="btn btn-outline-light px-3 px-md-4">
                        <i class="bi bi-arrow-left me-1"></i> <span class="d-none d-sm-inline">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container-fluid px-3 px-md-5 py-4 mt-2">
        
        <div class="row mb-4 align-items-center">
            <div class="col-12 col-md-8">
                <p class="fs-5 fw-bold text-dark mb-0">
                    Monitorea y gestiona las intersecciones de semáforos registradas en el sistema.
                </p>
            </div>
            <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                
                {{-- REGLA 1 ACTIVA: Solo el Administrador ve el botón "Nuevo Prototipo" --}}
                @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('prototipo.crear') }}" class="btn btn-primary px-4" style="background-color: #3b5a9a; border-color: #3b5a9a;">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Prototipo
                </a>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-card p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th># ID</th>
                                    <th>Intersección</th>
                                    <th>Dirección IP</th>
                                    <th>Modo de Operación</th>
                                    <th>Estado de Red</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prototipos as $prototipo)
                                <tr>
                                    <td class="fw-bold text-muted">00{{ $prototipo['id'] }}</td>
                                    <td class="fw-bold">{{ $prototipo['nombre'] }}</td>
                                    <td class="font-monospace text-muted">{{ $prototipo['ip'] }}</td>
                                    
                                    <td>
                                        @if($prototipo['modo'] == 'inteligente')
                                            <span class="badge badge-inteligente px-3 py-2 rounded-pill"><i class="bi bi-cpu me-1"></i> Inteligente</span>
                                        @elseif($prototipo['modo'] == 'fijo')
                                            <span class="badge badge-fijo px-3 py-2 rounded-pill"><i class="bi bi-stopwatch me-1"></i> Fijo</span>
                                        @else
                                            <span class="badge badge-mantenimiento px-3 py-2 rounded-pill"><i class="bi bi-tools me-1"></i> Mantenimiento</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($prototipo['estado'] == 'online')
                                            <div class="d-flex align-items-center text-success fw-bold">
                                                <i class="bi bi-circle-fill small me-2" style="font-size: 0.6rem;"></i> En línea
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center text-danger fw-bold">
                                                <i class="bi bi-circle-fill small me-2" style="font-size: 0.6rem;"></i> Fuera de línea
                                            </div>
                                        @endif
                                        <span class="text-muted" style="font-size: 0.8rem;">{{ $prototipo['ultima_conexion'] }}</span>
                                    </td>

                                    <td class="text-center text-nowrap">
                                        
                                        <!-- 1. Monitoreo / Estado (Dinámico según rol) -->
                                        <button class="btn btn-outline-primary btn-action" data-bs-toggle="tooltip" title="{{ auth()->check() && auth()->user()->role === 'admin' ? 'Control Manual' : 'Ver Estado en Vivo' }}">
                                            <i class="bi {{ auth()->check() && auth()->user()->role === 'admin' ? 'bi-joystick' : 'bi-display' }}"></i>
                                        </button>
                                        
                                        <!-- 2. Historial del Semáforo (Visible para todos) -->
                                        <button class="btn btn-outline-info btn-action" data-bs-toggle="tooltip" title="Ver Historial">
                                            <i class="bi bi-clock-history"></i>
                                        </button>

                                        {{-- REGLA 2 ACTIVA: Solo el Administrador puede Editar y Eliminar --}}
                                        @if(auth()->check() && auth()->user()->role === 'admin')
                                        <!-- 3. Editar -->
                                        <button class="btn btn-outline-secondary btn-action" data-bs-toggle="tooltip" title="Editar Tiempos/IP">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <!-- 4. Eliminar -->
                                        <button class="btn btn-outline-danger btn-action" data-bs-toggle="tooltip" title="Dar de baja">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</body>
</html>