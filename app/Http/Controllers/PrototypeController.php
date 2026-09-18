<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrototypeController extends Controller
{
    public function index()
    {
        // DATOS SIMULADOS: Simulamos lo que Eloquent traería de la Base de Datos
        $prototipos = [
            [
                'id' => 1,
                'nombre' => 'Eje Central y Madero',
                'ip' => '192.168.1.50',
                'modo' => 'inteligente',
                'estado' => 'online',
                'ultima_conexion' => 'Hace 2 min'
            ],
            [
                'id' => 2,
                'nombre' => 'Av. Politécnico y Montevideo',
                'ip' => '192.168.1.51',
                'modo' => 'fijo',
                'estado' => 'online',
                'ultima_conexion' => 'Hace 5 min'
            ],
            [
                'id' => 3,
                'nombre' => 'Av. San Andrés Atoto y Periférico',
                'ip' => '192.168.1.52',
                'modo' => 'mantenimiento',
                'estado' => 'offline',
                'ultima_conexion' => 'Hace 2 horas'
            ]
        ];

        // Retornamos la vista y le pasamos los datos simulados
        return view('admin.prototypes.index', compact('prototipos'));
    }
}