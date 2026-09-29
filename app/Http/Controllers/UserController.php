<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.users.index', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'role'      => 'required|in:admin,user',
        ]);

        User::create([
            'name'      => $request->name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    // MÉTODO PARA ACTUALIZAR (EDITAR)
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // El unique ignora el email del usuario actual para que no marque error si no lo cambia
            'email'     => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'role'      => 'required|in:admin,user',
        ]);

        $usuario->update([
            'name'      => $request->name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'role'      => $request->role,
        ]);

        // Solo actualizamos la contraseña si el administrador escribió una nueva
        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('usuarios.index');
    }

    // MÉTODO PARA ELIMINAR
    public function destroy(User $usuario)
    {
        // Seguridad: Evitar que el administrador se borre a sí mismo
        if (auth()->id() === $usuario->id) {
            return redirect()->route('usuarios.index');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}