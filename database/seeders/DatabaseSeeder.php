<?php

namespace Database\Seeders;

use App\Models\AirplaneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(30)->create();
        AirplaneModel::factory()->count(10)->create();
    }
}
