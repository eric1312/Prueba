<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tenant;

class System extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 
        'entry_point', 'metadata', 'is_active', 'is_public'
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'permissions')
            ->withTimestamps();
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}