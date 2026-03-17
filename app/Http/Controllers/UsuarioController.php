<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar vista de registro
    public function create()
    {
        return view('usuarios.create');
    }

        public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }
        public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->delete();

        return redirect()->route('dashboard')
                        ->with('success','Usuario eliminado correctamente');
    }


    // Mostrar listado de usuarios
    public function index()
    {
        // obtener todos los usuarios
        $usuarios = Usuario::all();

        // enviar datos a la vista
        return view('usuarios.index', compact('usuarios'));
    }


    // Guardar usuario en BD
public function store(Request $request)
{
    $request->validate([
        'nombre'     => 'required|string|max:100',
        'apellido'   => 'required|string|max:100',
        'telefono'   => 'nullable|string|max:20',
        'email'      => 'required|email|max:255|unique:usuarios,email',
        'contrasena' => 'required|string|min:6',
        'rol'        => 'required|in:user,admin',
    ]);

    $rolFinal = (session('usuario_rol') === 'admin') ? $request->rol : 'user';

    Usuario::create([
        'nombre'     => $request->nombre,
        'apellido'   => $request->apellido,
        'telefono'   => $request->telefono,
        'email'      => $request->email,
        'contrasena' => Hash::make($request->contrasena),
        'rol'        => $rolFinal,
    ]);

    return redirect()->route('dashboard')->with('success', 'Usuario registrado correctamente');
}
    

        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $data = $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'telefono' => 'nullable',
        'email' => 'required|email'
    ]);

    // Solo cambiar password si escriben algo
    if($request->contrasena){
        $data['contrasena'] = Hash::make($request->contrasena);
    }

    $usuario->update($data);

    return redirect()->route('dashboard')->with('success','Usuario actualizado');
}

    /**
     * Remove the specified resource from storage.
     */
}

