<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pastel;

class PastelController extends Controller
{
public function index()
{
    $pasteles = Pastel::orderBy('id', 'desc')->get();
    return view('pasteles.index', compact('pasteles'));
}
}
