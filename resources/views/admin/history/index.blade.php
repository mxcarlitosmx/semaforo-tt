<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Operaciones | Semáforo TT1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body style="background-color: #f8f9fa;">

    <!-- CABECERA -->
    <nav class="navbar navbar-dark py-3" style="background-color: #243447; border-bottom: 3px solid #3b5a9a;">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <span class="navbar-brand fw-bold fs-3"><i class="bi bi-clock-history me-2"></i>Historial de Operaciones</span>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light"><i class="bi bi-arrow-left me-1"></i> Volver</a>
        </div>
    </nav>

    <!-- TABLA DE RELLENO -->
    <div class="container-fluid px-4 py-5">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="p-3">ID</th>
                                <th class="p-3">Usuario (Admin)</th>
                                <th class="p-3">Acción</th>
                                <th class="p-3">Semáforo Afectado</th>
                                <th class="p-3">Dirección IP</th>
                                <th class="p-3">Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Registro de ejemplo 1 -->
                            <tr>
                                <td class="p-3">1</td>
                                <td class="p-3 fw-bold">Carlos Hernández</td>
                                <td class="p-3"><span class="badge bg-danger">Forzar Rojo</span></td>
                                <td class="p-3">Eje Central y Madero (ID: 3)</td>
                                <td class="p-3 text-muted">192.168.1.55</td>
                                <td class="p-3 text-muted">2026-09-20 10:15:00</td>
                            </tr>
                            <!-- Registro de ejemplo 2 -->
                            <tr>
                                <td class="p-3">2</td>
                                <td class="p-3 fw-bold">Carlos Hernández</td>
                                <td class="p-3"><span class="badge bg-primary">Alta de Usuario</span></td>
                                <td class="p-3 text-muted">N/A</td>
                                <td class="p-3 text-muted">192.168.1.55</td>
                                <td class="p-3 text-muted">2026-09-20 10:45:22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>