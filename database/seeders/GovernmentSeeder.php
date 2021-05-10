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
        $government_name = 'Cairo';
        DB::table('governments') -> insert([
            'name' => $government_name,
        ]);

    }
}
