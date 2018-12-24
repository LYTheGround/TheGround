<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Echeance extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prince','date','payed', 'buy_id','sale_id','company_id'];

    public function getPrinceAttribute($value)
    {
        return (int) $value;
    }

    public function setPrinceAttribute($value)
    {
        $this->attributes['prince'] = (string) $value;
    }

    public function buy()
    {
        return $this->belongsTo(Buy::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
