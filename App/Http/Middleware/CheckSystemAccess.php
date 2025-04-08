<?php
namespace App\Http\Middleware;

use Closure;

class CheckSystemAccess
{
    public function handle($request, Closure $next)
    {
        $system = $request->route('system');
        
        if (!$request->user()->systems->contains($system)) {
            abort(403, 'No tienes acceso a este sistema');
        }

        return $next($request);
    }
}