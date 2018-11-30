<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Token pour tester les enregistrement
        \App\Token::create([
            'token'     => md5(sha1(rand())),
            'range'     => 30,
            'category_id'   => 4,
            'company_id'    => 1
        ]);
    }
}
