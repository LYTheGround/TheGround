<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = ['profit','tva', 'taxes', 'tva_after_unload', 'taxes_after_unload', 'accounting_id', 'date'];

    public function unloads()
    {
        return $this->belongsToMany(Unload::class);
    }

    public function accounting()
    {
        return $this->belongsToMany(Accounting::class);
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }
    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    public static function month()
    {
        $accounting = auth()->user()->member->company->accounting;
        $month = self::issetMonth($accounting);
        if($month){
            return $month;
        }
        else{
            return self::create([
                'profit'             => 0,
                'tva'                => 0,
                'taxes'              => 0,
                'tva_after_unload'   => 0,
                'taxes_after_unload' => 0,
                'accounting_id'      => $accounting->id,
                'date'               => Carbon::now()
            ]);
        }
    }

    private static function issetMonth($accounting)
    {
        if(isset($accounting->months[0])){
            foreach ($accounting->months as $month){
                $date = new \DateTime($month->date);
                $m = $date->format('m');
                if($m == gmdate('m')){
                    return $month;
                }
            }
        }
        return false;
    }
}
