<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Afirmation;
use App\Models\Competencia;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'German Middi',
            'email' => 'g@gmail.com',
            'password' => bcrypt('Inicio123')
        ]);
       /*  Afirmation::create([
            'text' => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, velit" ,

        ]);
        Competencia::create([
            'competencia' => 'Autonomía',
            'definicion' => 'Se refiere a la capacidad de elegir con criterio propio; de llevar ',
            'comportamiento' => "El conocimiento de sí mism@, conciencia y aplicación de valores y actitudes personales "
        ]); */

        Category::create(['title'=> 'INNOVACIÓN']);
        Category::create(['title' => 'LOGRO']);
        Category::create(['title' => 'COLABORACIÓN']);
        Category::create(['title' => 'LIDERAZGO']);
        

        

        


    }
}
