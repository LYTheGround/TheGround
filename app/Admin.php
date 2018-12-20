<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Cette table consiste a indiquez les administrateurs.
 *
 * Class Admin
 * @package App
 */
class Admin extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = ['type', 'user_id','city_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
