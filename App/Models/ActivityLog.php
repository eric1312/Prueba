<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'log_name', 'description', 'subject_id', 'subject_type',
        'causer_id', 'causer_type', 'properties'
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function causer()
    {
        return $this->morphTo();
    }

    public function scopeForSystem($query, $systemId)
    {
        return $query->where('properties->system_id', $systemId);
    }
}