<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Systems\SystemController; // Corregido: "App" en mayúscula
use App\Http\Controllers\PostsController; // Asegúrate de que la ruta sea correcta

Route::get('/posts', function () {
    return response()->json([
        ['id' => 1, 'title' => 'Post 1'],
        ['id' => 2, 'title' => 'Post 2'],
    ]);
});

// Asegúrate de que el controlador SystemController exista
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/systems', [SystemController::class, 'index']); // Ruta para listar sistemas
    Route::get('/systems/{system}', [SystemController::class, 'show']) // Ruta para mostrar un sistema específico
         ->middleware('can:access,system');
});