<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'system_id', 'owner_id', 'name', 'subdomain',
        'database_name', 'configuration', 'status', 'expires_at'
    ];

    protected $casts = [
        'configuration' => 'array',
        'expires_at' => 'datetime',
    ];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'permissions')
            ->withTimestamps();
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }
}