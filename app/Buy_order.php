<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Buy_order
 * @package App
 */
class Buy_order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['pu', 'ht', 'tva', 'ttc', 'buy_dv_id', 'buy_bc_id'];

    /**
     * @param $value
     * @return int
     */
    public function getPuAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setPuAttribute($value)
    {
        $this->attributes['pu'] = (string) round($value,2);
    }
    /**
     * @param $value
     * @return int
     */
    public function getHtAttribute($value)
    {
        return (int) $value;
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
        return (int)$value;
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
    public function dv()
    {
        return $this->belongsTo(Buy_dv::class, 'buy_dv_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchased()
    {
        return $this->hasOne(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bc()
    {
        return $this->belongsTo(Buy_bc::class, 'buy_bc_id');
    }
}
