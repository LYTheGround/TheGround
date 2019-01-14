<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Agadir', 'Casablanca', 'Marrakech', 'Rabat', 'tanger'
        ];
        foreach ($cities as $city) {
            \App\City::create([
                'city' => $city
            ]);
        }
    }
}
