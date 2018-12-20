<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['slug', 'ht', 'tva', 'ttc', 'tva_payed', 'profit', 'taxes', 'profit_after_taxes', 'company_id', 'trade_action_id'];

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
     * @return int
     */
    public function getTvaAttribute($value)
    {
        return (int)$value;
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
     * @return string
     */
    public function setHtAttribute($value)
    {
        return $this->attributes['ht'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return string
     */
    public function setTvaAttribute($value)
    {
        return $this->attributes['tva'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return string
     */
    public function setTtcAttribute($value)
    {
        return $this->attributes['ttc'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getTva_payedAttribute($value)
    {
        return (int)$value;
    }

    /**
     * @param $value
     * @return string
     */
    public function setTva_payedAttribute($value)
    {
        return $this->attributes['tva_payed'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getProfitAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setProfitAttribute($value)
    {
        $this->attributes['profit'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getTaxesAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setTaxesAttribute($value)
    {
        $this->attributes['taxes'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getProfit_after_taxesAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setProfit_after_taxesAttribute($value)
    {
        $this->attributes['profit_after_taxes'] = (string) round($value,2);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trade_action()
    {
        return $this->belongsTo(Trade_action::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bcs()
    {
        return $this->hasMany(Sale_bc::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dv()
    {
        return $this->hasOne(Sale_dv::class);
    }
}
