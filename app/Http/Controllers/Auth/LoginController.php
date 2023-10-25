<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Formulario de Inicio de Sesion
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validación de datos de inicio de sesión
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Autenticación exitosa
            return redirect()->intended('/home'); // Redirigir a la ubicación deseada
        }

        // Autenticación fallida
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout(Request $request)
    {
        auth()->logout(); // Cierra la sesión del usuario
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token de seguridad

        return redirect('/login'); // Redirige a la página de inicio o la ubicación deseada
   
    }
}
