<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class VerifyTenantAccess
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = $request->route('tenant');
        
        if (! $request->user()->can('view', $tenant)) {
            abort(403, 'No tienes acceso a este tenant');
        }
        
        return $next($request);
    }
}