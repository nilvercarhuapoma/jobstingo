<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Mostrar el formulario de contacto
    public function showForm()
    {
        return view('contactanos');
    }

    // Procesar el formulario y enviar el correo
    public function sendEmail(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'issue' => 'required',
            'message' => 'required',
            'email' => 'required|email',
        ]);

        // Enviar el correo
        Mail::raw(
            "Mensaje de: {$request->email}\n\nAsunto: {$request->issue}\n\nMensaje:\n{$request->message}",
            function ($message) {
                $message->to('carhuapomapenanilverleimer@gmail.com')
                        ->subject('Nuevo mensaje desde el formulario de contacto');
            }
        );

        // Redirigir al usuario con un mensaje de éxito
        return back()->with('success', 'Tu mensaje ha sido enviado correctamente!');
    }
}
