<?php

namespace Database\Seeders;

use App\Models\Government;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governments = Government::factory()
                    ->count(5)
                    ->create();

    }
}
