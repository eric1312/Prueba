<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Http\Resources\SystemResource;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $systems = System::active()
            ->when(!auth()->check(), fn($q) => $q->public())
            ->get();

        return SystemResource::collection($systems);
    }

    public function show(System $system)
    {
        $this->authorize('view', $system);

        return new SystemResource($system);
    }

    public function userSystems(Request $request)
    {
        $systems = $request->user()->systems()
            ->withPivot('role')
            ->get();

        return SystemResource::collection($systems);
    }

    public function attachUser(Request $request, System $system)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
        ]);

        $system->users()->attach($request->user_id, [
            'role' => $request->role,
            'permissions' => json_encode($request->permissions ?? [])
        ]);

        return response()->json([
            'message' => 'Usuario asignado al sistema correctamente'
        ]);
    }
}