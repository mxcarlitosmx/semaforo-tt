<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Prototipo | Semáforo TT1</title>
    
    <!-- BOOTSTRAP 5 Y ÍCONOS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- LIBRERÍA LEAFLET CSS (Mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f4f7f6; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Cabecera del Panel */
        .navbar-custom {
            background-color: #243447; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid #3b5a9a;
            min-height: 85px; 
        }

        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            background-color: #ffffff;
        }

        /* Estilos modernos para los inputs */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #3b5a9a;
            box-shadow: 0 0 0 0.25rem rgba(59, 90, 154, 0.15);
        }

        .section-title {
            color: #243447;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Contenedor del mapa */
        #map {
            height: 480px; 
            border-radius: 12px;
            border: 2px solid #dee2e6;
            z-index: 1; 
        }
    </style>
</head>
<body>

    <!-- ========================================== -->
    <!-- CABECERA (LIMPIA Y CON LETRA MÁS GRANDE)   -->
    <!-- ========================================== -->
    <nav class="navbar navbar-dark navbar-custom py-3 py-md-4">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex justify-content-between align-items-center w-100">
                
                <!-- BLOQUE IZQUIERDO: Título Principal -->
                <div class="text-white">
                    <!-- fs-2 aumenta el tamaño significativamente para mejor distribución -->
                    <h1 class="fw-bold mb-0 fs-2">Registrar Nuevo Prototipo</h1>
                </div>

                <!-- BLOQUE DERECHO: Botón Volver -->
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light px-3 px-md-4">
                        <i class="bi bi-arrow-left me-1"></i> <span class="d-none d-sm-inline">Volver</span>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- CONTENIDO PRINCIPAL                        -->
    <!-- ========================================== -->
    <div class="container-fluid px-3 px-md-5 py-4 mt-2">
        
        <!-- INSTRUCCIONES: Fuera de la cabecera y en negritas -->
        <div class="row mb-4">
            <div class="col-12">
                <p class="fs-5 fw-bold text-dark mb-0">
                    Ingresa los datos técnicos y selecciona la ubicación en el mapa.
                </p>
            </div>
        </div>
        
        <!-- FORMULARIO Y MAPA -->
        <form action="#" method="POST">
            <div class="row g-4">
                
                <!-- COLUMNA IZQUIERDA: FORMULARIO TÉCNICO -->
                <div class="col-12 col-lg-5">
                    <div class="form-card p-4 h-100">
                        
                        <h5 class="section-title"><i class="bi bi-hdd-network me-2 text-primary"></i>Datos del Hardware</h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Nombre del Cruce / Intersección</label>
                            <input type="text" class="form-control" placeholder="Ej. Eje Central y Madero" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Dirección IP del Controlador</label>
                            <input type="text" class="form-control" placeholder="Ej. 192.168.1.50" required>
                            <small class="text-muted">La IP de la placa maestra que controla ambos sentidos.</small>
                        </div>

                        <h5 class="section-title mt-5"><i class="bi bi-stopwatch me-2 text-primary"></i>Tiempos Base (Failsafe)</h5>
                        <p class="text-muted small mb-3">Tiempos de ciclo equilibrado (50/50) en caso de pérdida de conexión con la nube.</p>
                        
                        <div class="row g-2 mb-4">
                            <div class="col-4">
                                <label class="form-label text-success fw-bold">Verde (s)</label>
                                <input type="number" class="form-control text-center border-success" value="45" min="10">
                            </div>
                            <div class="col-4">
                                <label class="form-label text-warning fw-bold">Amarillo (s)</label>
                                <input type="number" class="form-control text-center border-warning" value="4" min="2">
                            </div>
                            <div class="col-4">
                                <label class="form-label text-danger fw-bold">Rojo (s)</label>
                                <input type="number" class="form-control text-center border-danger" value="45" min="10">
                            </div>
                        </div>

                        <h5 class="section-title mt-5"><i class="bi bi-gear me-2 text-primary"></i>Estado Inicial</h5>
                        <div class="mb-4">
                            <select class="form-select border-primary">
                                <option value="fijo" selected>Modo Fijo (Recomendado al iniciar)</option>
                                <option value="mantenimiento">Modo Mantenimiento (Luces intermitentes)</option>
                                <option value="inteligente">Modo Inteligente (Dinámico)</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- COLUMNA DERECHA: GEOLOCALIZACIÓN Y MAPA -->
                <div class="col-12 col-lg-7">
                    <div class="form-card p-4 h-100">
                        
                        <h5 class="section-title"><i class="bi bi-geo-alt me-2 text-danger"></i>Ubicación Geográfica</h5>
                        <p class="text-muted small">Haz clic en el centro exacto del cruce. El algoritmo usará estas coordenadas para calcular el flujo de ambas avenidas.</p>
                        
                        <!-- CONTENEDOR DEL MAPA -->
                        <div id="map" class="mb-4 shadow-sm"></div>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-dark">Latitud</label>
                                <input type="text" id="lat-input" class="form-control bg-light" placeholder="0.000000" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold text-dark">Longitud</label>
                                <input type="text" id="lng-input" class="form-control bg-light" placeholder="0.000000" readonly>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="text-end mt-4 pt-3 border-top">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5" style="background-color: #3b5a9a; border-color: #3b5a9a;">
                                <i class="bi bi-save me-2"></i> Guardar Prototipo
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar el mapa centrado en la Ciudad de México por defecto
            var latCenter = 19.432608;
            var lngCenter = -99.133209;
            var map = L.map('map').setView([latCenter, lngCenter], 13);

            // Cargar los tiles de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = null;

            // Evento: Clic en el mapa para capturar latitud y longitud
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                if (marker !== null) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                // Autocompletar inputs a 6 decimales de precisión
                document.getElementById('lat-input').value = lat.toFixed(6);
                document.getElementById('lng-input').value = lng.toFixed(6);
            });
        });
    </script>
</body>
</html>