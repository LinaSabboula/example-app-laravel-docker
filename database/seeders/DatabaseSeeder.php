<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([GovernmentSeeder::class,
                    CitySeeder::class,
                    AreaSeeder::class,
                    UserSeeder::class,
                    AddressSeeder::class,
            ]);
    }
}
