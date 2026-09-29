<?php

use Illuminate\Support\Facades\Route;

// Importamos el controlador
use App\Http\Controllers\PrototypeController;

// Controlador usuarios:
use App\Http\Controllers\UserController;

// ==========================================
// RUTAS PÚBLICAS (No requieren sesión)
// ==========================================
Route::get('/', function () {
    return redirect()->route('login');
});

// Bloquear la funcion de registrar desde el login
Auth::routes(['register' => false]);


// ==========================================
// RUTAS PROTEGIDAS (Requieren iniciar sesión)
// ==========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ==========================================
    // RUTAS DEL ADMINISTRADOR
    // ==========================================
    Route::get('/panel-admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Ruta para ver el formulario de Crear Prototipo
    Route::get('/prototipos/crear', function () {
        return view('admin.prototypes.create');
    })->name('prototipo.crear');

    // Ruta para adminstrar Prototipos
    Route::get('/prototipos', [PrototypeController::class, 'index'])->name('prototipos.index');

    // Ruta para administrar usuarios Usuarios (MOSTRAR LA TABLA)
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    
    // Tuta para el formulario registro de usuario <--
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    // Ruta para administrar usuarios (MOSTRAR LA TABLA)
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    
    // Ruta para guardar un nuevo usuario (CREAR)
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    // Ruta para actualizar un usuario existente (EDITAR)
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

    // Ruta para eliminar un usuario (ELIMINAR)
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Ruta para el Historial de Operaciones
    Route::get('/historial', function () {
        return view('admin.history.index');
    })->name('historial.index');

    // Ruta para el Diccionario PLN
    Route::get('/pln', function () {
        return view('admin.pln.index');
    })->name('pln.index');


    // ==========================================
    // RUTAS DEL USUARIO NORMAL (OPERADOR)
    // ==========================================
    Route::get('/panel-usuario', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

});