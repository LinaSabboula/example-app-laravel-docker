<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city_name = 'Nasr City';
        $government_name = 'Cairo';
        $government_id = DB::table('governments')
                                ->where('name', 'like', $government_name)
                                ->value('id');

        DB::table('cities') -> insert([
            'name' => $city_name,
            'gov_id' => $government_id,
        ]);
    }
}
