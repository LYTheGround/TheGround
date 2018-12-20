<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_order extends Model
{
    protected $fillable = ['pu', 'ht', 'tva', 'ttc', 'tva_payed', 'profit', 'taxes', 'profit_after_taxes', 'sale_dv_id', 'sale_bc_id'];

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

    public function purchased()
    {
        return $this->hasOne(Purchased::class);
    }
}
