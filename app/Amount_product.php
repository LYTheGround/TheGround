<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 * @property float $ttcu
 * @property float $total
 * @property float $history
 * @property Product $product
 * @property Purchased $purchased
 * @property Company $company
 */
class Amount_product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['qt', 'ttcu', 'total', 'history', 'product_id', 'purchased_id', 'company_id'];


    /**
     * @param $value
     * @return float
     */
    public function getTtcuAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setTtcuAttribute($value)
    {
        $this->attributes['ttcu'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getTotalAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = (string) round($value,2);
    }

    /**
     * @param $value
     * @return float
     */
    public function getHistoryAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setHistoryAttribute($value)
    {
        $this->attributes['history'] = (string) round($value,2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchased()
    {
        return $this->belongsTo(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
