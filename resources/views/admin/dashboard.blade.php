<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | Semáforo TT1</title>
    
    <!-- 1. BOOTSTRAP 5 Y ÍCONOS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- 2. ESTILOS PERSONALIZADOS -->
    <style>
        body {
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden; 
        }

        /* Cabecera del Panel: Mayor altura y sombra */
        .navbar-custom {
            background-color: #243447; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid #3b5a9a;
            min-height: 85px; /* Altura reforzada */
        }

        /* Estilos de las Tarjetas */
        .admin-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #ffffff;
            cursor: pointer;
            height: 100%; 
        }

        @media (hover: hover) {
            .admin-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 30px rgba(59, 90, 154, 0.15);
                border-bottom: 5px solid #3b5a9a;
            }
        }

        .card-icon {
            font-size: 4rem; 
            color: #3b5a9a;
            margin-bottom: 20px;
        }

        /* Botón de Ayuda Flotante (?) */
        .btn-help {
            position: absolute;
            top: 15px;
            right: 15px;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: #e2e8f0;
            color: #64748b;
            border: none;
            transition: background-color 0.2s, color 0.2s;
            z-index: 10; 
        }

        .btn-help:hover, .btn-help:active {
            background-color: #d65b5b;
            color: white;
        }
    </style>
</head>
<body>

    <!-- ========================================== -->
    <!-- CABECERA (MÁS ALTA Y DISTRIBUIDA)          -->
    <!-- ========================================== -->
    <nav class="navbar navbar-dark navbar-custom py-4">
        <!-- container-fluid con padding para mandar los elementos a los extremos -->
        <div class="container-fluid px-3 px-md-5">
            <div class="row w-100 align-items-center m-0">
                
                <!-- BLOQUE 1: LOGO (Completamente a la izquierda) -->
                <div class="col-md-4 d-none d-md-flex justify-content-start align-items-center px-0">
                    <i class="bi bi-stoplights me-2 text-info fs-2"></i>
                    <span class="text-white fs-4 fw-bold">Sistema de Tráfico</span>
                </div>

                <!-- BLOQUE 2: BIENVENIDA (Centro exacto y en una sola línea) -->
                <div class="col-6 col-md-4 d-flex justify-content-start justify-content-md-center align-items-center px-0">
                    <span class="text-white text-nowrap fs-3">
                        ¡Bienvenido, <strong>Admin!</strong>
                    </span>
                </div>

                <!-- BLOQUE 3: CERRAR SESIÓN -->
                <div class="col-6 col-md-4 d-flex justify-content-end align-items-center px-0">
                    <a href="{{ route('logout') }}" 
                    class="btn btn-outline-light px-4 py-2"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>

                    <!-- Formulario oculto que ejecuta el cierre de sesión seguro en Laravel -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- CONTENIDO PRINCIPAL                        -->
    <!-- ========================================== -->
    <div class="container py-5 mt-3">
        
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold" style="color: #243447;">¿Qué deseas hacer hoy?</h2>
                <p class="text-muted fs-5">Selecciona un módulo para gestionar la plataforma.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            
            <!-- TARJETA 1: CREAR PROTOTIPO -->
             
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card admin-card p-4 text-center position-relative">
        
                    <!-- Botón de ayuda (?) -->
                    <button type="button" class="btn-help" data-bs-toggle="tooltip" data-bs-placement="top" title="Da de alta un nuevo semáforo en el mapa asignando su IP y ubicación.">?</button>
                
                    <!-- ENLACE A LA NUEVA VISTA -->
                    <!-- text-decoration-none quita la línea del link y text-dark mantiene el color de la letra -->
                    <a href="{{ route('prototipo.crear') }}" class="text-decoration-none text-dark d-block mt-2">
                        <div class="card-body">
                            <i class="bi bi-plus-circle-dotted card-icon"></i>
                            <h4 class="card-title fw-bold">Crear Prototipo</h4>
                            <p class="card-text text-muted">Añadir una nueva intersección de tráfico a la red inteligente.</p>
                        </div>
                    </a>
                    
                </div>
            </div>
            

            <!-- TARJETA 2: MIS PROTOTIPOS -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card admin-card p-4 text-center position-relative">
        
                    <!-- Botón de ayuda (?) -->
                    <button type="button" class="btn-help" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualiza estados, fuerza cambios de luces o elimina semáforos activos.">?</button>
                    
                    <!-- ENLACE A LA VISTA DE LA TABLA -->
                    <a href="{{ route('prototipos.index') }}" class="text-decoration-none text-dark d-block mt-2">
                        <div class="card-body">
                            <i class="bi bi-sliders card-icon"></i>
                            <h4 class="card-title fw-bold">Mis Prototipos</h4>
                            <p class="card-text text-muted">Gestionar, editar y monitorear los semáforos activos en tiempo real.</p>
                        </div>
                    </a>
        
                </div>
            </div>

            <!-- TARJETA 3: GESTIÓN DE USUARIOS -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card admin-card p-4 text-center position-relative h-100">
        
                     <button type="button" class="btn-help" data-bs-toggle="tooltip" data-bs-placement="top" title="Control de acceso: Agrega nuevos operadores de tránsito o modifica permisos.">?</button>
        
                    <!-- ENLACE A LA NUEVA VISTA -->
                    <a href="{{ route('usuarios.index') }}" class="text-decoration-none text-dark d-block mt-2">
                        <div class="card-body">
                            <i class="bi bi-people card-icon"></i>
                            <h4 class="card-title fw-bold">Gestión de Usuarios</h4>
                            <p class="card-text text-muted">Administrar cuentas, perfiles y accesos operativos del sistema.</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

    <!-- ========================================== -->
    <!-- SCRIPTS                                    -->
    <!-- ========================================== -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    
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