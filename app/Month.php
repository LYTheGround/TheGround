<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = ['profit', 'tva', 'taxes', 'tva_after_unload', 'taxes_after_unload', 'accounting_id', 'date'];

    public function getProfitAttribute($value)
    {
        return floatval($value);
    }

    public function setProfitAttribute($value)
    {
        $this->attributes['profit'] = (string) round($value,2);
    }

    public function getTvaAttribute($value)
    {
        return floatval($value);
    }

    public function setTvaAttribute($value)
    {
        $this->attributes['tva'] = (string) round($value,2);
    }

    public function getTaxesAttribute($value)
    {
        return floatval($value);
    }

    public function setTaxesAttribute($value)
    {
        $this->attributes['taxes'] = (string) round($value,2);
    }

    public function getTvaAfterUnloadAttribute($value)
    {
        return floatval($value);
    }

    public function setTvaAfterUnloadAttribute($value)
    {
        $this->attributes['tva_after_unload'] = (string) round($value,2);
    }

    public function getTaxesAfterUnloadAttribute($value)
    {
        return floatval($value);
    }

    public function setTaxesAfterUnloadAttribute($value)
    {
        $this->attributes['taxes_after_unload'] = (string) round($value,2);
    }

    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    public function accounting()
    {
        return $this->belongsTo(Accounting::class);
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function buys()
    {
        return $this->hasMany(Buy::class);
    }

    public static function month(): Month
    {
        $accounting = auth()->user()->member->company->accounting;
        $month = self::issetMonth($accounting);
        if ($month) {
            return $month;
        } else {
            return self::create(['profit' => 0, 'tva' => 0, 'taxes' => 0, 'tva_after_unload' => 0, 'taxes_after_unload' => 0, 'accounting_id' => $accounting->id, 'date' => Carbon::now()]);
        }
    }

    private static function issetMonth($accounting)
    {
        if (isset($accounting->months[0])) {
            foreach ($accounting->months as $month) {
                $date = new \DateTime($month->date);
                $m = $date->format('Y-m');
                if ($m == gmdate('Y-m')) {
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
        switch ($m) {
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
