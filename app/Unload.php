<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unload extends Model
{
    protected $fillable = ['justify', 'prince', 'taxes', 'tva', 'accounting_id','month_id'];

    public function accounting()
    {
        return $this->belongsTo(Accounting::class);
    }

    public function months()
    {
        return $this->belongsTo(Month::class);
    }
}
