<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (session('usuario_rol') !== 'admin') {
            // usuario normal: lo mandamos al catálogo
            return redirect()->route('pasteles.index');
        }

        return $next($request);
    }
}