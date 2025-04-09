<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\System;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $tenants = $request->user()->tenants()
            ->with('system')
            ->get();

        return TenantResource::collection($tenants);
    }

    public function store(Request $request, System $system)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'required|alpha_dash|unique:tenants',
        ]);

        $tenant = $system->tenants()->create([
            'owner_id' => $request->user()->id,
            'name' => $request->name,
            'subdomain' => Str::lower($request->subdomain),
            'database_name' => 'tenant_' . Str::random(10),
            'status' => 'pending',
        ]);

        // Aquí iría la lógica para provisionar el tenant (base de datos, etc.)
        // $this->provisionTenant($tenant);

        return new TenantResource($tenant->load('system'));
    }

    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        return new TenantResource($tenant->load('system', 'owner'));
    }

    public function users(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        return response()->json($tenant->users);
    }

    protected function provisionTenant(Tenant $tenant)
    {
        // Implementación de creación de base de datos, directorios, etc.
        // Esto puede variar según tu infraestructura
    }
}