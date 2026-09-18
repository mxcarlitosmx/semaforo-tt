<?php

use Illuminate\Support\Facades\Route;

// Importamos el controlador
use App\Http\Controllers\PrototypeController;

// Controlador usuarios:
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/panel-admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Ruta para ver el formulario de Crear Prototipo
Route::get('/prototipos/crear', function () {
    // Asegúrate de haber guardado el archivo en resources/views/admin/prototypes/create.blade.php
    return view('admin.prototypes.create');
})->name('prototipo.crear');

//Mis Prototipos
Route::get('/prototipos', [PrototypeController::class, 'index'])->name('prototipos.index');


// Usuarios:
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
