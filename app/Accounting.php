<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Accounting
 * @package App
 */
class Accounting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['tva', 'taxes', 'profit', 'taxes_after_unload', 'tva_after_unload', 'company_id'];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        ];

    /**
     * @param $value
     * @return int
     */
    public function getTvaAttribute($value)
    {
        return (int) $value;
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
    public function getTaxes_after_unloadAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setTaxes_after_unloadAttribute($value)
    {
        $this->attributes['taxes_after_unload'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return int
     */
    public function getTva_after_unloadAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @param $value
     */
    public function setTva_after_unloadAttribute($value)
    {
        $this->attributes['tva_after_unload'] = (string) round($value,2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unloads()
    {
        return $this->hasMany(Unload::class);
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
    public function months()
    {
        return $this->hasMany(Month::class);
    }
}
