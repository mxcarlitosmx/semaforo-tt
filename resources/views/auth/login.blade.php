<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- BOOTSTRAP VÍA CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ÍCONOS DE BOOTSTRAP (Necesarios para el ojito) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #ffffff;
            overflow: hidden; /* Evita cualquier scroll no deseado */
            /* Tipografía Neogrotesca / Geométrica sin serifas */
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* =========================================
           DISEÑO DE LA TARJETA DE LOGIN
        ========================================= */
        .login-card {
            border-radius: 25px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.08);
            background-color: #ffffff;
            width: 100%;
            max-width: 480px; 
            border: 1px solid #f4f4f4;
            position: relative;
            z-index: 10;
        }

        .text-bienvenido {
            color: #04338b; 
            font-weight: 600; /* Un poco más de peso para la fuente geométrica */
            font-size: 3.5rem;
            letter-spacing: -1.5px; /* Estrecha un poco las letras para el estilo moderno */
        }

        .btn-login {
            background-color: #3b5a9a; 
            border-color: #3b5a9a;
            font-size: 1.25rem;
            padding: 14px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #2d4678;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(59, 90, 154, 0.3);
        }

        .form-control {
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 1.1rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3b5a9a;
            box-shadow: 0 0 0 0.25rem rgba(59, 90, 154, 0.15);
        }

        .form-label {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #4a4a4a;
            font-weight: 500;
        }

        /* Ajustes específicos para el grupo del input con el botón del ojo */
        .input-group-text.ojo-btn {
            background-color: transparent;
            border: 2px solid #e9ecef;
            border-left: none;
            border-radius: 0 12px 12px 0;
            cursor: pointer;
            color: #6c757d;
            transition: all 0.3s;
        }
        
        .form-control.con-ojo {
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        /* Al hacer focus en el input, pintar también el borde del ojito */
        .input-group:focus-within .ojo-btn,
        .input-group:focus-within .form-control.con-ojo {
            border-color: #3b5a9a;
        }

        .auth-links a {
            color: #4a4a4a;
            font-size: 1.05rem;
            text-decoration: none;
            margin-top: 15px;
            display: block;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #3b5a9a;
            text-decoration: underline;
        }

        /* =========================================
           LA RED AZUL Y ANIMACIONES (EL ENTORNO)
        ========================================= */
        .red-fondo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 140%; 
            height: 140%;
            z-index: 1;
            opacity: 0.8;
            animation: rotarRed 60s linear infinite;
        }

        @keyframes rotarRed {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .semaforo-wrapper {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================================
           DISEÑO DEL SEMÁFORO GIGANTE
        ========================================= */
        /* =========================================
   DISEÑO DEL SEMÁFORO GIGANTE
========================================= */
.semaforo-cuerpo {
    background-color: #243447; 
    padding: 40px 55px;
    border-radius: 45px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.6), inset 0 0 20px rgba(0,0,0,0.9);
    display: flex;
    flex-direction: column;
    gap: 30px;
    position: relative;
    z-index: 2;
    /* Escala reducida a 0.85 para encajar perfectamente en el viewport */
    transform: scale(1.15); 
    animation: flotar 4s ease-in-out infinite;
}

@keyframes flotar {
    0% { transform: scale(1.15) translateY(0px); }
    50% { transform: scale(1.15) translateY(-15px); }
    100% { transform: scale(1.15) translateY(0px); }
}

        .semaforo-cuerpo::before {
            content: '';
            position: absolute;
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 35px;
            height: 150px;
            background: linear-gradient(to right, #15202b, #2c3e50, #15202b);
            box-shadow: inset 0 0 10px rgba(0,0,0,0.8);
        }

        .luz-contenedor {
            position: relative;
        }
        
        .luz-contenedor::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -15px;
            right: -15px;
            height: 50px;
            background-color: #1a252f;
            border-radius: 60px 60px 0 0;
            z-index: 3;
            box-shadow: 0 8px 15px rgba(0,0,0,0.6);
        }

        .luz {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            box-shadow: inset 0 10px 25px rgba(0,0,0,0.9);
            border: 6px solid #15202b;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease-in-out;
        }

        .luz.roja { background-color: #3b1010; }
        .luz.amarilla { background-color: #4a3b08; }
        .luz.verde { background-color: #0b3015; }

        .luz.verde.activa {
            background-color: #2ecc71;
            border-color: #4cd137;
            animation: latidoVerde 2s infinite;
        }

        @keyframes latidoVerde {
            0% { box-shadow: 0 0 50px #2ecc71, inset 0 0 20px rgba(255,255,255,0.7); }
            50% { box-shadow: 0 0 90px #4cd137, inset 0 0 35px rgba(255,255,255,0.9); }
            100% { box-shadow: 0 0 50px #2ecc71, inset 0 0 20px rgba(255,255,255,0.7); }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row min-vh-100 m-0">
        
        <!-- COLUMNA IZQUIERDA: RED AZUL + SEMÁFORO -->
        <div class="col-12 col-lg-7 d-none d-lg-block position-relative p-0 overflow-hidden">
            <div class="semaforo-wrapper">
                
                <!-- DIBUJO DE LA RED -->
                <div class="red-fondo">
                    <svg width="100%" height="100%" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="5" result="blur" />
                                <feComposite in="SourceGraphic" in2="blur" operator="over" />
                            </filter>
                        </defs>
                        <g stroke="#00d4ff" stroke-width="2" opacity="0.4">
                            <line x1="400" y1="150" x2="600" y2="300" />
                            <line x1="400" y1="150" x2="200" y2="300" />
                            <line x1="200" y1="300" x2="250" y2="550" />
                            <line x1="600" y1="300" x2="550" y2="550" />
                            <line x1="250" y1="550" x2="400" y2="700" />
                            <line x1="550" y1="550" x2="400" y2="700" />
                            <line x1="200" y1="300" x2="600" y2="300" />
                            <line x1="250" y1="550" x2="550" y2="550" />
                            <line x1="400" y1="150" x2="400" y2="700" />
                            <line x1="100" y1="400" x2="200" y2="300" />
                            <line x1="100" y1="400" x2="250" y2="550" />
                            <line x1="700" y1="400" x2="600" y2="300" />
                            <line x1="700" y1="400" x2="550" y2="550" />
                        </g>
                        <g fill="#00ffff" filter="url(#glow)">
                            <circle cx="400" cy="150" r="8" />
                            <circle cx="200" cy="300" r="8" />
                            <circle cx="600" cy="300" r="8" />
                            <circle cx="250" cy="550" r="8" />
                            <circle cx="550" cy="550" r="8" />
                            <circle cx="400" cy="700" r="8" />
                            <circle cx="100" cy="400" r="6" />
                            <circle cx="700" cy="400" r="6" />
                        </g>
                    </svg>
                </div>

                <!-- EL SEMÁFORO -->
                <div class="semaforo-cuerpo">
                    <div class="luz-contenedor"><div class="luz roja"></div></div>
                    <div class="luz-contenedor"><div class="luz amarilla"></div></div>
                    <div class="luz-contenedor"><div class="luz verde activa"></div></div>
                </div>

            </div>
        </div>

        <!-- COLUMNA DERECHA: TARJETA DE LOGIN -->
        <div class="col-12 col-lg-5 d-flex justify-content-start align-items-center p-4 p-lg-0 pe-lg-5">
            <div class="login-card p-5 mt-4 mt-lg-0 ms-lg-4">
                
                <h1 class="text-center text-bienvenido mb-5">Bienvenido</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- CAMPO DE CORREO -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="usuario@gmail.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- CAMPO DE CONTRASEÑA CON EL OJO -->
                    <div class="mb-5">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control con-ojo @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            
                            <!-- Botón del Ojo -->
                            <span class="input-group-text ojo-btn" id="togglePassword">
                                <i class="bi bi-eye-slash" id="iconPassword"></i>
                            </span>
                        </div>
                        
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-login w-100 text-white rounded-3 mb-4">
                        Login
                    </button>

                    <div class="text-center auth-links">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Olvidó su contraseña</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script para alternar la visibilidad de la contraseña
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const iconPassword = document.querySelector('#iconPassword');

    togglePassword.addEventListener('click', function (e) {
        // Alternar el tipo de input (password/text)
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Alternar el ícono (ojo abierto/cerrado)
        if (type === 'password') {
            iconPassword.classList.remove('bi-eye');
            iconPassword.classList.add('bi-eye-slash');
        } else {
            iconPassword.classList.remove('bi-eye-slash');
            iconPassword.classList.add('bi-eye');
        }
    });
</script>
</body>
</html>