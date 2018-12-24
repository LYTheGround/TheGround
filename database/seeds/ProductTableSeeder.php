<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = \App\Company::first();
        for($i = 1; $i < 6; $i++){
            $company->products()->create([
                'slug'          => "product-0-$i",
                'name'          => "product-0$i",
                'ref'           => "PROD-00$i",
                'tva'           => 20,
                'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                'qt'            => 0,
                'qt_min'        => 10,
                'member_id'     => 1
            ]);
        }

    }
}
