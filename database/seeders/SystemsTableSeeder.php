<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        System::create([
            'name' => 'Sistema de Gestión',
            'slug' => 'gestion',
            'description' => 'Sistema principal de gestión empresarial',
            'entry_point' => '/gestion',
            'is_active' => true
        ]);
        // Más sistemas según necesidad
    }
}
