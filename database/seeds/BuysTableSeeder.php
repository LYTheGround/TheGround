<?php

use Illuminate\Database\Seeder;

class BuysTableSeeder extends Seeder
{
    private $ht = 0;
    private $tva = 0;
    private $ttc = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // trade_action
        $trade = $this->trade_action();
        // buy
        $buy = $this->buy($trade);
        // bcs
        $this->bcs($buy);
        // dvs
        $dv1 = $this->dv($buy,1,1,5000,1);
        $dv2 = $this->dv($buy,2,2,5100,false);
        $dv3 = $this->dv($buy,3,3,5200,false);
        // orders
        foreach ($buy->bcs as $bc){
            $this->order($dv1,$bc,100,1);
            $this->order($dv2,$bc,101,2);
            $this->order($dv3,$bc,103,3);
        }
    }

    private function trade_action()
    {
        return \App\Trade_action::create([
            'bc'                => 1,
            'bc_member_id'      => 4,
            'bc_time'           => Carbon\Carbon::now(),
            'dv'                => 1,
            'dv_member_id'      => 4,
            'dv_time'           => Carbon\Carbon::now(),
            'done'              => 1,
            'done_member_id'    => 4,
            'done_time'         => Carbon\Carbon::now(),
            'delivery'          => 1,
            'delivery_member_id'=> 5,
            'delivery_time'     => \Carbon\Carbon::now(),
            'store'             => 1,
            'store_member_id'   => 6,
            'store_time'        => \Carbon\Carbon::now(),
            'bl'                => 'images/bl/bl.jpg',
            'bl_member_id'      => 6,
            'bl_time'           => \Carbon\Carbon::now(),
            'fc'                => 'images/fc/fc.jpg',
            'fc_member_id'      => 3,
            'fc_time'           => \Carbon\Carbon::now(),
            'tasks'             => json_encode(['next' => null,'progress' => 100]),
            'status'            => 'finish',
            'company_id'        => 1
        ]);
    }

    private function buy(\App\Trade_action $trade_action)
    {
        return $trade_action->buy()->create([
            'slug'          => 'B-1',
            'user_id'       => 1,
            'company_id'    => 1,
            'ht'            => 5000,
            'tva'           => 1000,
            'ttc'           => 6000
        ]);
    }

    private function bcs(\App\Buy $buy)
    {
        $products = \App\Product::all();
        foreach ($products as $product) {
            $product->buy_bcs()->create([
                'buy_id'    => $buy->id,
                'qt'        => 10
            ]);
        }
    }

    private function dv(\App\Buy $buy,int $provider,int $i, int $ht, bool $selected)
    {
        $tva = ($ht * 20) / 100;
        $ttc = $tva + $ht;
        if($i == 1){
            \App\Month::create([
                'profit'                => 0,
                'tva'                   => $tva,
                'tva_after_unload'      => $tva,
                'taxes'                 => 0,
                'taxes_after_unload'    => 0,
                'accounting_id'         => 1,
                'date'                  => Carbon\Carbon::now()
            ]);
        }

        return $buy->dvs()->create([
            'slug'          => 'DV-' . $i,
            'provider_id'   => $provider,
            'ht'            => $ht,
            'tva'           => $tva,
            'ttc'           => $ttc,
            'selected'      => $selected
        ]);
    }

    private function order(\App\Buy_dv $dv,\App\Buy_bc $bc,int $pu,int $i)
    {
        $ht  = $pu * (int) $bc->qt;
        $tva = ($ht * 20) / 100;
        $ttc = $ht + $tva;
        $order = $dv->orders()->create([
            'pu'        => $pu,
            'ht'        => $ht,
            'tva'       => $tva,
            'ttc'       => $ttc,
            'buy_bc_id' => $bc->id,
        ]);

        if($dv->id == 1){
            $accounting = \App\Accounting::first();
            $accounting->update([
                'tva'                    => $order->tva + $accounting->tva,
                'tva_after_unload'       => $order->tva + $accounting->tva,
            ]);
            $order->purchased()->create([
                'slug'      => 'buy-' . $i,
                'qt'        => $bc->qt,
                'store_qt'  => $bc->qt,
                'offer_qt'  => $bc->qt,
                'product_id'=> $bc->product_id,
                'accounting_id' => 1,
                'month_id'  => 1
            ]);
        }
    }

    private function buys()
    {
        // new buy and new trade_action
        $trade = \App\Trade_action::create([
            'status'    => 'finish'
        ]);
        // return buy
        return $trade->buy()->create([
            'slug'          => 'B-1',
            'user_id'       => 1,
            'company_id'    => 1,
            'ht'            => 0,
            'tva'           => 0,
            'ttc'           => 0
        ]);
    }

    private function bc(\App\Buy $buy)
    {
        for ($i = 0; $i < 5; $i++) {
            $buy->bcs()->create([
                'qt'    => 10,
                'product_id' => $i
            ]);
        }
        $buy->trade_action()->update([

            'bc'                => 1,
            'bc_member_id'      => 4,
            'bc_time'           => Carbon\Carbon::now(),
        ]);
    }

    private function dv_orders(\App\Buy $buy,$i)
    {
        $dv = $buy->dvs()->create([
            'slug'          => 'DV-' . $i,
            'provider_id'   => 1,
        ]);
        foreach ($buy->bcs as $bc){
            $pu = rand(1,120);
            $ht = $pu * $bc->qt;
            $tva = $ht * 0.2;
            $ttc = $ht + $tva;
            $bc->order()->create([
                'pu'        => 10,
                'ht'        => $ht,
                'tva'       => $tva,
                'ttc'       => $ttc,
                'buy_dv_id' => $dv->id
            ]);
            $dv->update([
                'ht'    => $dv->ht + $ht,
                'tva'   => $dv->tva + $tva,
                'ttc'   => $dv->ttc + $ttc
            ]);
        }
        $dv->update(['selected' => true]);
        $buy->trade_action()->update([
            'dv'                => 1,
            'dv_member_id'      => 4,
            'dv_time'           => Carbon\Carbon::now(),
        ]);
    }

    private function done(\App\Buy $buy)
    {

    }
    private function l()
    {
        // foreach buy with $i
        // buy. -
        // bc(buy). -
        // dv_order(buy)
        // selected_confirm (buy)
        // done(buy)
        // store (buy)
        // delivery ()
        for ($i = 1; $i < 5; $i++){
            $buy = $this->buys();
            $this->bc($buy);
            $this->dv_orders($buy,$i);
        }

    }
}
