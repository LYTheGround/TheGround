<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * All attributes was assigned in mass
     *
     * @var array
     */
    protected $guarded = ['city'];

    /**
     * @var array
     */
    protected $casts = [
        'created_at'    => 'datetime:d-m-Y',
        'updated_at'    => 'datetime:d-m-Y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function infos()
    {
        return $this->hasMany(Info::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function info_boxes()
    {
        return $this->hasMany(Info_box::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
