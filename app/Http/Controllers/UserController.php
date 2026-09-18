<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // DATOS SIMULADOS: Simulamos los usuarios registrados en tu sistema
        $usuarios = [
            [
                'id' => 1,
                'name' => 'Carlos',
                'last_name' => 'Hernández',
                'email' => 'carlos.admin@tt1.com',
                'role' => 'admin',
                'is_active' => true,
                'created_at' => '2026-08-10'
            ],
            [
                'id' => 2,
                'name' => 'Operador',
                'last_name' => 'Turno Matutino',
                'email' => 'operador1@tt1.com',
                'role' => 'user',
                'is_active' => true,
                'created_at' => '2026-08-12'
            ],
            [
                'id' => 3,
                'name' => 'Operador',
                'last_name' => 'Baja',
                'email' => 'inactivo@tt1.com',
                'role' => 'user',
                'is_active' => false,
                'created_at' => '2026-08-15'
            ]
        ];

        return view('admin.users.index', compact('usuarios'));
    }
}