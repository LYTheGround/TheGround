<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount_product extends Model
{
    protected $fillable = ['qt', 'ttcu', 'total', 'history', 'product_id', 'purchased_id', 'company_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchased()
    {
        return $this->belongsTo(Purchased::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
