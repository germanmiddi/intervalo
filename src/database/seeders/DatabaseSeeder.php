<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Afirmation;
use App\Models\Competencia;
use App\Models\Category;
use App\Models\TestStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'German Middi',
            'email' => 'g@gmail.com',
            'password' => bcrypt('Inicio123')
        ]);

        Category::create(['title'=> 'INNOVACIÓN']);
        Category::create(['title' => 'LOGRO']);
        Category::create(['title' => 'COLABORACIÓN']);
        Category::create(['title' => 'LIDERAZGO']);

        $status = [
                    ['description' => 'ABANDONED'],
                    ['description' => 'FINISHED']
                ];

        TestStatus::insert($status);
        
    }
}
