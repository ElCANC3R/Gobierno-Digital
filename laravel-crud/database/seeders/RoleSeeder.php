<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Acceso total al sistema'
        ]);

        Role::create([
            'name' => 'Usuario',
            'slug' => 'user',
            'description' => 'Acceso limitado al sistema'
        ]);
    }
}
