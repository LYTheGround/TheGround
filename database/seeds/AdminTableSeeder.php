<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'login'     => "admin",
            'email'     => "admin@ly.ly",
            'password'  => bcrypt("066145392mM")
        ]);
        $user->admin()->create([
            'type'      => 'A',
            'city_id'   => 1,
        ]);
    }
}
