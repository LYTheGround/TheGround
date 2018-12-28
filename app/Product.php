<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'name', 'ref', 'tva', 'size', 'description', 'qt', 'qt_min', 'amount', 'min_prince', 'company_id'];

    /**
     * @var array
     */
     protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function getTvaAttribute($value)
    {
        return (int) $value;
    }
    public function setTvaAttribute($value)
    {
        $this->attributes['tva'] = (string) $value;
    }
    public function getQtAttribute($value)
    {
        return (int) $value;
    }
    public function setQtAttribute($value)
    {
        $this->attributes['qt'] = (string) $value;
    }
    public function getQtMinAttribute($value)
    {
        return (int) $value;
    }
    public function setQtMinAttribute($value)
    {
        $this->attributes['qt_min'] = (string) $value;
    }
    public function getMinPrinceAttribute($value)
    {
        return floatval($value);
    }
    public function setMinPrinceAttribute($value)
    {
        $this->attributes['min_prince'] = (string) round($value,2);
    }
    public function getAmountAttribute($value)
    {
        return floatval($value);
    }
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (string) round($value,2);
    }
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imgs()
    {
        return $this->hasMany(Product_img::class);
    }

    public function buy_bcs()
    {
        return $this->hasMany(Buy_bc::class);
    }

    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class)->withPivot('min_prince', 'updated_at','created_at');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class)->withPivot('min_prince', 'updated_at', 'created_at');
    }

    public function productAmounts()
    {
        return $this->hasMany(Amount_product::class);
    }
}
