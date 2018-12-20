<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Buy_dv
 * @package App
 */
class Buy_dv extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'ht', 'tva', 'ttc', 'selected', 'buy_id', 'provider_id'];


    /**
     * @param $value
     * @return int
     */
    public function getHtAttribute($value)
    {
        return (int)$value;
    }

    /**
     * @param $value
     */
    public function setHtAttribute($value)
    {
        $this->attributes['ht'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getTvaAttribute($value)
    {
        return (int)$value;
    }

    /**
     * @param $value
     */
    public function setTvaAttribute($value)
    {
        $this->attributes['tva'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getTtcAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setTtcAttribute($value)
    {
        $this->attributes['ttc'] = (string) round($value,2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buy()
    {
        return $this->belongsTo(Buy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Buy_order::class);
    }
}
