<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @property array $fillable
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 * @property float $ht
 * @property float $tva
 * @property float $ttc
 * @property Company $company
 * @property Trade_action $trade_action
 * @property Buy_bc $bcs
 * @property Buy_dv $dvs
 * @property User $user
 * @property Echeance $echeance
 */
class Buy extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'ht', 'tva', 'ttc', 'user_id', 'company_id', 'trade_action_id'];

    /**
     * @param $value
     * @return int
     */
    public function getHtAttribute($value)
    {
        return floatval($value);
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
     * @return int
     */
    public function getTvaAttribute($value)
    {
        return floatval($value);
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
     * @return int
     */
    public function getTtcAttribute($value)
    {
        return floatval($value);
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
        return $this->hasMany(Buy_bc::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dvs()
    {
        return $this->hasMany(Buy_dv::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function finish()
    {
        return $this->belongsTo(Trade_action::class)->where('status', '=', 'finish');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function echeance()
    {
        return $this->hasOne(Echeance::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
