<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pastel;

class DashboardController extends Controller
{
    public function index()
    {
        $rol = session('usuario_rol');

        // Datos base del dashboard
        $data = [
            'totalPasteles' => Pastel::count(),
        ];

        // Si es admin, también mostramos usuarios
        if ($rol === 'admin') {
            $data['usuarios'] = Usuario::orderBy('id', 'desc')->get();
            $data['totalUsuarios'] = Usuario::count();
        }

        // Para usuario normal, solo verá catálogo (y no verá usuarios)
        $data['pasteles'] = Pastel::orderBy('id', 'desc')->get();

        return view('dashboard', $data);
    }
}