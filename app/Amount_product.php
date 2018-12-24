<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount_product extends Model
{
    protected $fillable = ['qt', 'ttcu', 'total', 'history', 'product_id', 'purchased_id', 'company_id'];


    public function getTtcAttribute($value)
    {
        return floatval($value);
    }

    public function setTtcAttribute($value)
    {
        $this->attributes['ttcu'] = (string) round($value,2);
    }

    public function getTotalAttribute($value)
    {
        return floatval($value);
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = (string) round($value,2);
    }

    public function getHistoryAttribute($value)
    {
        return floatval($value);
    }

    public function setHistoryAttribute($value)
    {
        $this->attributes['history'] = (string) round($value,2);
    }

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
