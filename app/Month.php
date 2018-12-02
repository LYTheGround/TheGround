<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = ['profit','tva', 'taxes', 'tva_after_unload', 'taxes_after_unload', 'accounting_id', 'date'];

    public function unloads()
    {
        return $this->hasMany(Unload::class);
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

    public static function date(Month $month)
    {
        $date = new \DateTime($month->date);
        $m = $date->format('m');
        $y = $date->format('Y');
        switch ($m){
            case 1:
            return 'Janvier' . $y;
            break;
            case 2:
            return 'Février' . $y;
            break;
            case 3:
            return 'Mars' . $y;
            break;
            case 4:
            return 'Avril' . $y;
            break;
            case 5:
            return 'Mai' . $y;
            break;
            case 6:
            return 'Juin ' . $y;
            break;
            case 7:
            return 'Juillet ' . $y;
            break;
            case 8:
            return 'Août ' . $y;
            break;
            case 9:
            return 'September ' . $y;
            break;
            case 10:
            return 'October ' . $y;
            break;
            case 11:
            return 'November ' . $y;
            break;
            case 12:
            return 'December ' . $y;
            break;
        }

    }
}
