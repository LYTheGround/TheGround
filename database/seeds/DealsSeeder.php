<?php

use Illuminate\Database\Seeder;

class DealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++){
            $info = \App\Info_box::create([
                'name'      => "provider $i",
                'speaker'   => "provider",
                'city_id'   => 1,
                'address'   => 'address address address address address ',
                'build'     => 1
            ]);
            $info->tels()->create([
                'tel'   => "062256891$i",
                'default' => true
            ]);
            $info->emails()->create([
                'email'     => "provider$i@ly.ly",
                'default'   => 1
            ]);
            $info->provider()->create([
                'slug'          => "provider-$i",
                'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'company_id'    => 1,
                'user_id'       => 1
            ]);
        }
        for ($i = 1; $i < 4; $i++){
            $info = \App\Info_box::create([
                'name'      => "client $i",
                'speaker'   => "client",
                'city_id'   => 1,
                'address'   => 'address address address address address ',
                'build'     => 1
            ]);
            $info->tels()->create([
                'tel'   => "062256892$i",
                'default' => true
            ]);
            $info->emails()->create([
                'email'     => "client$i@ly.ly",
                'default'   => 1
            ]);
            $info->client()->create([
                'slug'      => "client-$i",
                'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'company_id'    => 1,
                'user_id'       => 1
            ]);
        }
    }
}
