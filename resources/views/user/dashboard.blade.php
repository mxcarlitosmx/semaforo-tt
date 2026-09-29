<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Operador | Semáforo TT1</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        .navbar-custom { background-color: #1a252f; border-bottom: 3px solid #2ecc71; min-height: 85px; } /* Color distinto (verde/gris oscuro) para diferenciar perfiles */
        .admin-card { border: none; border-radius: 18px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); transition: transform 0.3s ease, box-shadow 0.3s ease; background-color: #ffffff; cursor: pointer; height: 100%; }
        .admin-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(46, 204, 113, 0.15); border-bottom: 5px solid #2ecc71; }
        .card-icon { font-size: 4rem; color: #2ecc71; margin-bottom: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom py-4">
        <div class="container-fluid px-3 px-md-5">
            <div class="row w-100 align-items-center m-0">
                <div class="col-md-4 d-none d-md-flex justify-content-start align-items-center px-0">
                    <i class="bi bi-stoplights me-2 text-success fs-2"></i>
                    <span class="text-white fs-4 fw-bold">Sistema de Tráfico</span>
                </div>
                <div class="col-6 col-md-4 d-flex justify-content-start justify-content-md-center align-items-center px-0">
                    <span class="text-white text-nowrap fs-3">
                        ¡Bienvenido, Operador <strong>{{ auth()->check() ? auth()->user()->name : '' }}!</strong>
                    </span>
                </div>
                <div class="col-6 col-md-4 d-flex justify-content-end align-items-center px-0">
                    <a href="{{ route('logout') }}" class="btn btn-outline-light px-4 py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5 mt-3">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold" style="color: #1a252f;">Módulo Operativo</h2>
                <p class="text-muted fs-5">Selecciona la red de semáforos a monitorear.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- TARJETA ÚNICA DEL USUARIO: MIS PROTOTIPOS -->
            <div class="col-12 col-md-6 col-lg-5">
                <!-- Por ahora usamos la misma ruta prototipos.index, la vista allá ocultará los botones que no debe ver -->
                <a href="{{ route('prototipos.index') }}" class="text-decoration-none text-dark d-block mt-2">
                    <div class="card admin-card p-5 text-center position-relative h-100">
                        <div class="card-body">
                            <i class="bi bi-display card-icon"></i>
                            <h3 class="card-title fw-bold">Monitor de Tráfico</h3>
                            <p class="card-text text-muted fs-5 mt-3">Consultar estado en tiempo real, alertas de red y bitácora individual de las intersecciones.</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Aquí puedes agregar futuras tarjetas exclusivas del usuario (ej. Reportes Diarios, Estadísticas Básicas, etc.) -->
        </div>
    </div>

</body>
</html>