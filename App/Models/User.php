<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'status', 'preferences'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'preferences' => 'array',
    ];

    public function systems()
    {
        return $this->belongsToMany(System::class)
            ->withPivot('role', 'permissions')
            ->withTimestamps();
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'owner_id');
    }

    public function hasAccessToSystem($systemId)
    {
        return $this->systems()->where('system_id', $systemId)->exists();
    }
}