<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // Mostrar el perfil en la misma página
    public function showProfile()
    {
        return view('profile', ['user' => auth::user()]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome'); // Redirige al inicio después de cerrar sesión
    }

    // Actualizar el perfil
    public function updateProfile(Request $request)
    {
        // Validación del archivo
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Solo imágenes
        ]);
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si se ha subido una nueva imagen
        if ($request->hasFile('profile_picture')) {
            // Subir la nueva imagen y obtener la ruta
            $imagePath = $request->file('profile_picture')->store('profiles', 'public'); // Guardar en 'storage/app/public/profiles'
    
            // Actualizar la foto de perfil en la base de datos
            $user->profile_picture = $imagePath;
            $user->save(); // Guardar el cambio en la base de datos
        }
    
        return redirect()->route('profile')->with('success', 'Foto de perfil actualizada.');
    }
    



    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('login'); // Asegúrate de tener el archivo login.blade.php
    }

    // Procesar login
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'job-option' => 'required|string|in:dar-trabajo,buscar-trabajo', // Asegurarse de que la opción sea válida
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Obtener el usuario autenticado
            $user = auth()->user();

            // Obtener la opción seleccionada
            $jobOption = $request->input('job-option'); // 'dar-trabajo' o 'buscar-trabajo'

            // Verificar que la opción es válida y asignarla
            if (in_array($jobOption, ['dar-trabajo', 'buscar-trabajo'])) {
                // Guardar la opción seleccionada en la base de datos
                $user->job_option = $jobOption;
                $user->save();
            } else {
                // Si no es válida, asignar un valor predeterminado
                $user->job_option = 'buscar-trabajo';
                $user->save();
            }

            // Guardar la opción en la sesión para redirigir al usuario correctamente
            session(['job_option' => $jobOption]);

            // Redirigir al usuario según la opción seleccionada
            if ($jobOption === 'dar-trabajo') {
                return redirect()->route('welcome'); // Redirige a la vista de crear trabajo
            } else {
                return redirect()->route('welcome'); // Redirige a la vista de buscar trabajo
            }
        }

        // Si las credenciales son incorrectas, redirigir de nuevo con un mensaje de error
        return back()->withErrors([
            'email' => 'email o contraseña incorrecta',
        ]);
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('register'); // Asegúrate de tener el archivo register.blade.php
    }

    // Procesar registro
    public function register(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255', // Nuevo campo
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|regex:/^9\d{8}$/', // Validar teléfono que empiece con 9 y tenga 9 dígitos
            'password' => 'required|string|min:8|confirmed', // Confirmación de contraseña
        ], [
            'email.unique' => 'Ese correo electrónico ya está registrado.',
            'phone.regex' => 'El teléfono debe empezar con 9 y tener 9 dígitos.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Crear el usuario en la base de datos
        \App\Models\User::create([
            'name' => $request->name,
            'lastname' => $request->lastname, // Guardar apellido
            'email' => $request->email,
            'phone' => $request->phone, // Guardar teléfono
            'password' => bcrypt($request->password), // Encriptar contraseña
        ]);

        // Redirigir al login después del registro
        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Inicia sesión.');
    }
}
