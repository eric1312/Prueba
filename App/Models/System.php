<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    // Si la tabla no sigue la convención de nombres, especifica el nombre de la tabla
    protected $table = 'systems';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'url',
        'is_active',
    ];
}