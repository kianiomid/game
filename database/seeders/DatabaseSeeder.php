<?php

namespace Database\Seeders;

use App\Models\GameCode;
use App\Models\GameMethod;
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
        GameCode::factory(5)->create();
        GameMethod::factory(1)->create();
    }
}
