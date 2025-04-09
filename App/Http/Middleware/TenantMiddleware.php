<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = Tenant::where('subdomain', $request->route('tenant'))->firstOrFail();
        
        if (!$tenant->isActive()) {
            abort(403, 'Esta instancia no está activa');
        }
        
        // Configurar la conexión a la base de datos del tenant
        config(['database.connections.tenant.database' => $tenant->database_name]);
        
        // Establecer el tenant actual en el container de Laravel
        app()->instance('currentTenant', $tenant);
        
        return $next($request);
    }
}