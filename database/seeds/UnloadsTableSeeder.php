<?php

use Illuminate\Database\Seeder;

class UnloadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accounting = \App\Accounting::where('id',1)->first();
        $accounting->unloads()->create([
            'name'      => 'name unload',
            'justify' => 'join.jpg',
            'prince' => 1000,
            'tva' => true,
            'month_id' => 1,
            'member_id' => 1,
            'description' => 'description description description description description '
        ]);
        $accounting->update([
            'taxes_after_unload' => (floatval($accounting->taxes_after_unload) - 1000)
        ]);
        $month = $accounting->months[0];
        $month->update([
            'taxes_after_unload' => (floatval($month->taxes_after_unload) - 1000)
        ]);

    }
}
