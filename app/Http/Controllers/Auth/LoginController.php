<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'contrasena' => 'required|string',
        ]);

        $usuario = \App\Models\Usuario::where('email', $request->email)->first();

        if (!$usuario || !\Illuminate\Support\Facades\Hash::check($request->contrasena, $usuario->contrasena)) {
            return back()
                ->withErrors(['email' => 'Credenciales incorrectas'])
                ->withInput();
        }

        session([
            'usuario_id'     => $usuario->id,
            'usuario_nombre' => $usuario->nombre,
            'usuario_rol'    => $usuario->rol,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Sesión cerrada');
    }
}
