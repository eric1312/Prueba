<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     * El método index será el encargado de manejar la lógica para la ruta /usuarios. 
     * Por ejemplo, si deseas devolver una lista de usuarios
     */
    public function index()
    {
        // Obtiene todos los usuarios
        $usuarios = User::all();

        // Retorna los usuarios como respuesta JSON
        return response()->json($usuarios);
    }
}
