<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property mixed $attributes
 * @property float $tva
 * @property float $taxes
 * @property float $profit
 * @property float $taxes_after_unload
 * @property float $tva_after_unload
 * @property Purchased $purchaseds
 * @property Sold $solds
 * @property Unload $unloads
 * @property Company $company
 * @property Month $months
 */
class Accounting extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'tva', 'taxes', 'profit', 'taxes_after_unload', 'tva_after_unload', 'company_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y', 'updated_at' => 'datetime:d-m-Y'
    ];

    /**
     * @param $value
     * @return float
     */
    public function getTvaAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setTvaAttribute($value)
    {
        $this->attributes['tva'] = (string)round($value, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getTaxesAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setTaxesAttribute($value)
    {
        $this->attributes['taxes'] = (string)round($value, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getProfitAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setProfitAttribute($value)
    {
        $this->attributes['profit'] = (string) round($value, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getTaxesAfterUnloadAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setTaxesAfterUnloadAttribute($value)
    {
        $this->attributes['taxes_after_unload'] = (string) round($value, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getTvaAfterUnloadAttribute($value)
    {
        return floatval ($value);
    }

    /**
     * @param $value
     */
    public function setTvaAfterUnloadAttribute($value)
    {
        $this->attributes['tva_after_unload'] = (string) round($value, 2);
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
