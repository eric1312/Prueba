<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TenantController;

Route::prefix('v1')->group(function () {
    // Autenticación
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Rutas protegidas
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        
        // Sistemas
        Route::get('/systems/mine', [SystemController::class, 'userSystems']);
        Route::post('/systems/{system}/attach-user', [SystemController::class, 'attachUser']);
        
        // Tenants
        Route::apiResource('tenants', TenantController::class)->except(['update', 'destroy']);
        Route::get('/tenants/{tenant}/users', [TenantController::class, 'users']);
        Route::post('/systems/{system}/tenants', [TenantController::class, 'store']);
    });
    
    // Rutas públicas
    Route::apiResource('systems', SystemController::class)->only(['index', 'show']);
});