<?php

namespace App;

use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Premium
 * @package App
 */
class Premium extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['sold', 'range', 'limit', 'category_id', 'update_status', 'status_id'];

    protected $casts = [
        'created_at'        => 'datetime:d-m-Y',
        'updated_at'        => 'datetime:d-m-Y',
    ];
    public function getSoldAttribute($value)
    {
        return (int) $value;
    }
    public function setSoldAttribute($value)
    {
        $this->attributes['sold'] = (string) $value;
    }
    public function getRangeAttribute($value)
    {
        return (int) $value;
    }
    public function setRangeAttribute($value)
    {
        $this->attributes['range'] = (string) $value;
    }
    /**
     * @var string
     */
    protected $table = 'premiums';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function updateStatusMember($status, Company $company, Premium $premium)
    {
        if($status != $premium->status_id){
            if($premium->status_id == 1){
                if($status == 2){
                    $premium->update([
                        'range' => 0,
                        'limit' => $this->addDate($premium->range,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
                elseif ($status == 3){
                    $company->premium->update([
                        'sold' => $company->premium->sold + $premium->range
                    ]);
                    $premium->update([
                        'range' => 0,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 2){
                if($status == 1){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    $days = $diff / (60 * 60 * 24);
                    $premium->update([
                        'range' => $days,
                        'limit' => null,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif($status == 3){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    $days = $diff / (60 * 60 * 24);
                    $company->premium->update([
                        'sold'  => $company->premium->sold + $days
                    ]);
                    $premium->update([
                        'limit' => null,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 3){
                $company->premium->update([
                    'sold'  => $company->premium->sold - 1
                ]);
                if($status == 1){
                    $premium->update([
                        'range' => 1,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif ($status == 2){
                    $premium->update([
                        'limit' => $this->addDate(1,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
            }
        }
    }

    private function addDate($range, $date)
    {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'. $range .'D')); // P1D means a period of 1 day
        return  $date->format('Y-m-d');
    }

    public function updateStatusCompany($status, Premium $premium)
    {
        if($status != $premium->status_id){
            if($premium->status_id == 1){
                if($status == 2){
                    $premium->update([
                        'range' => 0,
                        'limit' => $this->addDate($premium->range,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
                elseif ($status == 3){
                    $premium->update([
                        'range' => 0,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 2){
                if($status == 1){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    $days = $diff / (60 * 60 * 24);
                    $premium->update([
                        'range' => $days,
                        'limit' => null,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif($status == 3){
                    $premium->update([
                        'limit' => null,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 3){
                if($status == 1){
                    $premium->update([
                        'range' => 1,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif ($status == 2){
                    $premium->update([
                        'limit' => $this->addDate(1,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
            }
        }
    }

    public function updateStatus($status,Company $company)
    {
        $members = $company->members;
        foreach ($members as $member){
            $this->updateStatusMember($status,$company,$member->premium);
        }
        $this->updateStatusCompany($status,$company->premium);
    }

    public static function diffDaysLimit($limit)
    {

        $end = strtotime($limit);
        $start = strtotime(gmdate('Y-m-d'));
        $diff = $end - $start;
        return $diff / (60 * 60 * 24);
    }
}
