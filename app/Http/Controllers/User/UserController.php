<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Validación de datos del formulario
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear un nuevo usuario en la base de datos
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encriptar la contraseña

        $user->save();

        // Verificar si el usuario ya tiene una sesión activa
        if (auth()->check()) {
            // Si ya hay una sesión activa, redirigir al usuario a la vista home con un mensaje
            return redirect('/home')->with('creado', 'ok');
        } else {
            // Si no hay una sesión activa, redirigir al usuario a la vista login con un mensaje
            return redirect('/login')->with('creado', 'ok');
        }
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Verifica si el usuario actual es el mismo que el usuario que se va a eliminar
        if ($user->id === auth()->user()->id) {
            return redirect()->route('home')->with('eliminar', 'Error');
        }

        $user->delete();
        return redirect()->route('home')->with('eliminar', 'Ok');
    }
}
