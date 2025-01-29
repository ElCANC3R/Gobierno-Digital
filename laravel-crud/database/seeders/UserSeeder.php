<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los roles disponibles
        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        // Crear 15 usuarios con el factory
        $users = User::factory(15)->create(); // Crea los usuarios

        // Asignarles roles a los usuarios (algunos administradores, otros usuarios)
        foreach ($users as $index => $user) {
            // Asignamos el rol de administrador a los primeros 3 usuarios
            if ($index < 3) {
                $user->roles()->attach($adminRole->id);
            } else {
                $user->roles()->attach($userRole->id);
            }
        }
    }
}

