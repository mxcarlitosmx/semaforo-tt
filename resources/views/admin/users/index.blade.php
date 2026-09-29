<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios | Semáforo TT1</title>
    
    <!-- BOOTSTRAP 5 Y ÍCONOS -->
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

        /* Estilos del Modal (Formulario Emergente) */
        .modal-header {
            background-color: #243447;
            color: white;
            border-bottom: 3px solid #3b5a9a;
        }
        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
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

    <!-- ========================================== -->
    <!-- CABECERA -->
    <!-- ========================================== -->
    <nav class="navbar navbar-dark navbar-custom py-3 py-md-4">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="text-white">
                    <h1 class="fw-bold mb-0 fs-2">Gestión de Usuarios</h1>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light px-3 px-md-4">
                        <i class="bi bi-arrow-left me-1"></i> <span class="d-none d-sm-inline">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- CONTENIDO PRINCIPAL -->
    <!-- ========================================== -->
    <div class="container-fluid px-3 px-md-5 py-4 mt-2">
        
        <div class="row mb-4 align-items-center">
            <div class="col-12 col-md-8">
                <p class="fs-5 fw-bold text-dark mb-0">
                    Administra el acceso operativo al sistema. Registra o edita cuentas.
                </p>
            </div>
            <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                <button type="button" class="btn btn-primary px-4" style="background-color: #3b5a9a; border-color: #3b5a9a;" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">
                    <i class="bi bi-person-plus-fill me-1"></i> Registrar Usuario
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-card p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>Correo Electrónico</th>
                                    <th>Rol de Sistema</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $user)
                                <tr>
                                    <td class="fw-bold">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            {{ $user->name }} {{ $user->last_name }}
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                    
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="bi bi-shield-lock me-1"></i> Super Admin</span>
                                        @else
                                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill"><i class="bi bi-person-badge me-1"></i> Operador</span>
                                        @endif
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <!-- BOTÓN EDITAR -->
                                        <button class="btn btn-outline-secondary btn-action" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario{{ $user->id }}" title="Editar Datos">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- BOTÓN ELIMINAR (Oculto para el propio administrador logueado) -->
                                        @if(auth()->id() !== $user->id)
                                        <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar permanentemente a este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-action" title="Eliminar Usuario">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>

                                <!-- MODAL ESPECÍFICO DE EDICIÓN PARA ESTE USUARIO -->
                                <div class="modal fade text-start" id="modalEditarUsuario{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                                            
                                            <div class="modal-header bg-secondary text-white border-bottom-0">
                                                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Editar Usuario</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            
                                            <div class="modal-body p-4 bg-light">
                                                <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold text-dark small">Nombre(s)</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold text-dark small">Apellidos</label>
                                                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label fw-bold text-dark small">Correo Electrónico</label>
                                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <label class="form-label fw-bold text-dark small">Rol de Acceso</label>
                                                            <select name="role" class="form-select border-primary">
                                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Operador</option>
                                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Super Admin</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 mt-3">
                                                            <label class="form-label fw-bold text-dark small">Nueva Contraseña <span class="text-muted fw-normal">(Opcional)</span></label>
                                                            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para mantener la actual">
                                                        </div>
                                                    </div>

                                                    <div class="text-end mt-4 pt-3 border-top">
                                                        <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-success px-4">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN DEL MODAL DE EDICIÓN -->

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL: FORMULARIO DE NUEVO USUARIO -->
    <!-- ========================================== -->
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalNuevoUsuarioLabel"><i class="bi bi-person-plus me-2"></i>Registrar Nuevo Usuario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4 bg-light">
                    <!-- PRÓXIMO PASO: Apuntar al método store del controlador -->
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small">Nombre(s)</label>
                                <input type="text" name="name" class="form-control" placeholder="Ej. Juan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small">Apellidos</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Ej. Pérez" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-dark small">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" placeholder="usuario@tt1.com" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-dark small">Contraseña Temporal</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                <small class="text-muted" style="font-size: 0.75rem;">El usuario deberá usarla para iniciar sesión.</small>
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold text-dark small">Rol de Acceso</label>
                                <select name="role" class="form-select border-primary">
                                    <option value="user" selected>Operador (Acceso al monitoreo y control manual)</option>
                                    <option value="admin">Super Admin (Control total del sistema)</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary px-4" style="background-color: #3b5a9a; border-color: #3b5a9a;">Crear Cuenta</button>
                        </div>
                    </form>
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