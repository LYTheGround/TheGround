<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_order extends Model
{
    protected $fillable = ['pu', 'ht', 'tva', 'ttc', 'tva_payed', 'profit', 'taxes', 'profit_after_taxes', 'sale_dv_id', 'sale_bc_id'];

    public function bc()
    {
        return $this->belongsTo(Sale_bc::class,'sale_bc_id');
    }

    public function dv()
    {
        return $this->belongsTo(Sale_dv::class,'sale_dv_id');
    }

    public function sold()
    {
        return $this->hasOne(Sold::class);
    }
}
