<?php

namespace Database\Seeders;

use App\Models\TestStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TestStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
                [
                    'description' => 'ABANDONED'
                ],
                [
                    'description' => 'FINISHED'
                ]
        ];

        TestStatus::insert($status);
        
    }
}
