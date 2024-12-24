<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        // Validación
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|confirmed|min:8',
        ]);

        // Hashear la contraseña
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Crear el usuario
        User::create($validatedData);

        // Redirigir con un mensaje
        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
