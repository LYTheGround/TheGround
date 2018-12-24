<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unload extends Model
{
    protected $fillable = ['name','justify', 'prince', 'taxes', 'tva', 'accounting_id','month_id','member_id','description'];

    /**
     * @param $value
     * @return int
     */
    public function getPrinceAttribute($value)
    {
        return floatval($value);
    }

    /**
     * @param $value
     */
    public function setPrinceAttribute($value)
    {
        $this->attributes['prince'] = (string) round($value,2);
    }

    public function accounting()
    {
        return $this->belongsTo(Accounting::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function unload()
    {
        $month = $this->month;
        $accounting = $this->accounting;
        // define taxes and tva
        if($this->tva){
            $taxes = false;
        }
        else{
            $taxes = true;
        }
        // avec ces influences aux autre table "Month, Accounting"
        if($taxes){
            $month->update([
                'taxes_after_unload' => (int) $month->taxes_after_unload + (int) $this->prince
            ]);
            $accounting->update([
                'taxes_after_unload' => (int) $accounting->taxes_after_unload + (int) $this->prince
            ]);
        }
        else{
            $month->update([
                'tva_after_unload' => $month->tva_after_unload + $this->prince
            ]);
            $accounting->update([
                'tva_after_unload' => $accounting->tva_after_unload + $this->prince
            ]);
        }
        // retiré le prince et la tva et les taxes
        $this->update([
            'prince' => 0,
            'taxes' => false,
            'tva'   => false,
        ]);
        // et rendre l'entré vierge
        return $this;
    }

    public function charge($data)
    {
        // define taxes and tva
        if($data['charge'] =='tva'){
            $data['tva'] = true;
            $data['taxes'] = false;
            $taxes = false;
        }
        else{
            $data['tva'] = false;
            $data['taxes'] = true;
            $taxes = true;
        }
        $month = $this->month;
        $accounting = $this->accounting;
        // avec ces influences aux autre table "Month, Accounting"
        if($taxes == true){
            $ac = (int) $month->taxes_after_unload - (int) $data['prince'];
            $month->update([
                'taxes_after_unload' => $ac
            ]);
            $accounting->update([
                'taxes_after_unload' => (int) $accounting->taxes_after_unload - (int) $data['prince']
            ]);
        }
        else{
            $month->update([
                'tva_after_unload' => $month->tva_after_unload - $data['prince']
            ]);
            $accounting->update([
                'tva_after_unload' => $accounting->tva_after_unload - $data['prince']
            ]);
        }
        // add data avec en affectant le nom de la justify

        $this->update($data);
        // et retourné la résultat
    }
}
