<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
                ['name' => 'Administrador','description' => 'Administrador total del sistema.'],
                ['name' => 'Manager','description' => 'Administrador total dentro de una empresa'],
                ['name' => 'Empleado','description' => 'Usuario basico, perteneciente a una empresa'],
                
        ];

        Rol::insert($status);
        
    }
}
