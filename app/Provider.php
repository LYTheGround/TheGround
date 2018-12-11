<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider
 * @package App
 */
class Provider extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'description', 'company_id', 'user_id', 'info_box_id'];

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
    public function info_box()
    {
        return $this->belongsTo(Info_box::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dvs()
    {
        return $this->hasMany(Buy_dv::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
