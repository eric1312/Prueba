<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemsController extends Controller
{
    // Método para listar todos los sistemas
    public function index()
    {
        $systems = System::all(); // Obtiene todos los registros de la tabla 'systems'
        return response()->json($systems);
    }

    // Método para mostrar un sistema específico
    public function show(System $system)
    {
        return response()->json($system);
    }
}
