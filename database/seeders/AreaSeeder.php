<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area_name = 'Makram';
        $city_name = 'Nasr City';
        $city_id = DB::table('cities')
                        ->where('name','like', $city_name)
                        ->value('id');

        DB::table('areas') -> insert([
            'name' => $area_name,
            'city_id' => $city_id,
        ]);
    }
}
