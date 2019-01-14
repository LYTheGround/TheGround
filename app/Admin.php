<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Cette table consiste a indiquez les administrateurs.
 *
 * Class Admin
 * @package App
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 * @property string $type
 * @property User $user
 * @property City $city
 */
class Admin extends Model
{

    /**
     *
     * @var array
     */
    protected $fillable = ['type', 'user_id','city_id'];

    /**
     * @param string $value
     * @return string
     */
    public function getTypeAttribute(string $value): string
    {
        return $value;
    }

    /**
     * @param string $value
     * @internal param string $type
     */
    public function setTypeAttribute(string $value)
    {
        $this->attributes['type'] = $value;
    }

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
