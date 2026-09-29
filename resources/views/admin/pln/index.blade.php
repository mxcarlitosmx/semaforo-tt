<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diccionario PLN | Semáforo TT1</title>
    <!-- BOOTSTRAP 5 Y ÍCONOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Estilos personalizados para mantener consistencia con el dashboard */
        body { background-color: #f8f9fa; }
        .navbar-custom { background-color: #243447; border-bottom: 3px solid #3b5a9a; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .btn-custom-primary { background-color: #3b5a9a; border-color: #3b5a9a; }
        .btn-custom-primary:hover { background-color: #2d4678; border-color: #2d4678; }
    </style>
</head>
<body>

    <!-- ========================================== -->
    <!-- CABECERA -->
    <!-- ========================================== -->
    <nav class="navbar navbar-dark py-3 navbar-custom">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <span class="navbar-brand fw-bold fs-3"><i class="bi bi-robot me-2"></i>Diccionario PLN</span>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light"><i class="bi bi-arrow-left me-1"></i> Volver</a>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- CONTENIDO PRINCIPAL -->
    <!-- ========================================== -->
    <div class="container-fluid px-4 py-5">
        
        <!-- Encabezado de sección y botón para abrir Modal -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="text-secondary fw-bold mb-0">Corpus Semántico del Motor PLN</h4>
                <!-- Botón que activa el Modal (data-bs-toggle="modal" y data-bs-target="#modalAgregarPalabra") -->
                <button type="button" class="btn btn-custom-primary text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarPalabra">
                    <i class="bi bi-plus-lg me-1"></i> Agregar Palabra
                </button>
            </div>
        </div>

        <!-- Tabla de Datos PLN -->
        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="p-3">ID</th>
                                <th class="p-3">Término / Token</th>
                                <th class="p-3">Categoría</th>
                                <th class="p-3 text-center">Peso (Prioridad)</th>
                                <th class="p-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Regla Simulada 1 -->
                            <tr>
                                <td class="p-3 text-muted">1</td>
                                <td class="p-3 fw-bold text-dark">ambulancia</td>
                                <td class="p-3"><span class="badge bg-danger">Emergencia</span></td>
                                <td class="p-3 text-center"><span class="badge bg-dark fs-6">0.95</span></td>
                                <td class="p-3 text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Editar"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Regla Simulada 2 -->
                            <tr>
                                <td class="p-3 text-muted">2</td>
                                <td class="p-3 fw-bold text-dark">choque</td>
                                <td class="p-3"><span class="badge bg-warning text-dark">Incidente</span></td>
                                <td class="p-3 text-center"><span class="badge bg-dark fs-6">0.85</span></td>
                                <td class="p-3 text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Editar"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL: AGREGAR NUEVA PALABRA AL PLN -->
    <!-- ========================================== -->
    <!-- El ID 'modalAgregarPalabra' debe coincidir con el data-bs-target del botón superior -->
    <div class="modal fade" id="modalAgregarPalabra" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                
                <!-- Cabecera del Modal -->
                <div class="modal-header text-white" style="background-color: #243447; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title fw-bold" id="modalLabel">
                        <i class="bi bi-file-earmark-text me-2"></i>Nueva Regla Semántica
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Cuerpo del Modal (El Formulario) -->
                <!-- Por ahora el action="#" es simulado. Luego lo cambiaremos a route('pln.store') -->
                <form action="#" method="POST">
                    <!-- @csrf (Protección de Laravel, actívalo cuando conectes la BD real) -->
                    
                    <div class="modal-body p-4">
                        <p class="text-muted mb-4">Ingresa el término que el algoritmo deberá reconocer y asígnale su nivel de prioridad.</p>
                        
                        <!-- Campo: Palabra / Término -->
                        <!-- En la BD: varchar(255) Not Null, Unique -->
                        <div class="mb-3">
                            <label for="palabra" class="form-label fw-bold">Palabra Clave o Token <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="palabra" name="palabra" placeholder="Ej. bomberos, tráfico pesado" required>
                            <div class="form-text">Debe ser único en el diccionario.</div>
                        </div>

                        <!-- Campo: Categoría -->
                        <!-- En la BD: varchar(255) Not Null -->
                        <div class="mb-3">
                            <label for="categoria" class="form-label fw-bold">Categoría Semántica <span class="text-danger">*</span></label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="" selected disabled>Selecciona una categoría...</option>
                                <option value="Emergencia">Emergencia (Bomberos, Policía)</option>
                                <option value="Incidente">Incidente (Choque, Falla)</option>
                                <option value="Congestión">Congestión (Tráfico, Embotellamiento)</option>
                                <option value="Clima">Clima (Lluvia, Inundación)</option>
                                <option value="Normal">Flujo Normal</option>
                            </select>
                        </div>

                        <!-- Campo: Peso (Prioridad) -->
                        <!-- En la BD: decimal(8, 2) Not Null -->
                        <div class="mb-3">
                            <label for="peso" class="form-label fw-bold">Peso del Algoritmo (0.01 al 1.00) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                                <!-- step="0.01" permite decimales. min y max restringen el valor -->
                                <input type="number" class="form-control" id="peso" name="peso" step="0.01" min="0.01" max="1.00" placeholder="Ej. 0.90" required>
                            </div>
                            <div class="form-text">Valores cercanos a 1.00 fuerzan cambios de luz inmediatos.</div>
                        </div>
                    </div>

                    <!-- Pie del Modal (Botones) -->
                    <div class="modal-footer bg-light" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-custom-primary px-4 shadow-sm">Guardar Regla</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- SCRIPTS -->
    <!-- ========================================== -->
    <!-- Requeridos para que funcione el Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>
</html>