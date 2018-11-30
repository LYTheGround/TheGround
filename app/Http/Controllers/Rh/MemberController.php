<?php

namespace App\Http\Controllers\Rh;

use App\Http\Requests\Premium\RangeRequest;
use App\Http\Requests\Premium\StatusRequest;
use App\Http\Requests\RH\InfoRequest;
use App\Member;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = auth()->user()->member->company->members;
        return view('rh.member.index',compact('members'));
    }

    public function show(Member $member)
    {
        $this->authorize('view',$member);
        return view('rh.member.show',compact('member'));
    }

    public function params()
    {
        $member = auth()->user()->member;
        return view('rh.member.params',compact('member'));
    }

    public function updateParams(InfoRequest $request)
    {
        // update info
        $member = auth()->user()->member;
        $info = $member->info;
        $r = $request->all();
        // update face
        if(!is_null($request->file('face'))){
            if($info->face){
                Storage::disk('public')->delete($info->face);
            }
            $face = $request->file('face')->store('face');
            $r['face'] = $face;
        }
        $info->update($r);
        $member->update($r);
        // update identity
        auth()->user()->update([
            'login' => $r[$request->identity]
        ]);
        return redirect()->route('member.show',compact('member'));
    }

    public function range(Member $member)
    {
        if($member->premium->status->status == 'inactive' || $member->premium->status->status == 'active'){
            if($member->premium->status->status == 'inactive'){
                session()->flash('status','ce compte est désactiver il ne peux bénéficier que si il est activer');
            }
            return view('rh.member.range',compact('member'));
        }
        session()->flash('status','cette acton est interdite ce compte est archiver');
        return back();
    }

    public function updateRange(RangeRequest $request,Member $member)
    {
        $premium = $member->premium;
        $premium_company = $member->company->premium;
        $range = $premium->range + $request->range;
        if($premium->category->category != 'pdg'){
            if($premium->status->status == 'inactive'){
                $this->addRange($range,$premium);
                $this->sold($request->range,$premium_company);
            }
            elseif($premium->status->status == 'active'){
                $date = $this->addDate($range,$premium->limit);
                $this->updateDate($date,$premium);
                $this->sold($range,$premium_company);
            }
            else{
                abort(403);
            }
        }
        $date = $this->addDate($range,$premium->limit);
        $this->updateDate($date,$premium);
        $this->updateDate($date,$premium_company);
        $this->sold($range,$premium_company);
        return redirect()->route('member.show',compact('member'));
    }

    private function addDate($range, $date)
    {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'. $range .'D')); // P1D means a period of 1 day
        return  $date->format('Y-m-d');
    }

    private function addRange($range, $premium)
    {
        return $premium->update(['range' => $range]);
    }

    private function sold($range, $premium)
    {
        return $premium->update(['sold' => $premium->sold - $range]);
    }

    public function status(Member $member)
    {
        if($member->premium->category->category == 'pdg'){
            session()->flash('status', 'vous ête pdg');
            return redirect()->route('member.show',compact('member'));
        }
        if($this->canUpdateStatus($member->premium)){
            return view('rh.member.status',compact('member'));
        }
        session()->flash('status', 'le status est bloquez j\'usque ' . $member->premium->update_status);
        return redirect()->route('member.show',compact('member'));

    }

    public function updateStatus(StatusRequest $request, Member $member)
    {
        $premium = $member->premium;
        $status = $request->status;
        $company = $member->company;
        if($this->canUpdateStatus($premium)){
            if($status != $premium->status_id){
                if($premium->status_id == 1){
                    if($request->status == 2){
                        $premium->update([
                            'range' => 0,
                            'limit' => $this->addDate($premium->range,date('Y-m-d')),
                            'status_id' => 2
                        ]);
                    }
                    elseif ($request->status == 3){
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
                    if($request->status == 1){
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
                    elseif($request->status == 3){
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
                    if($request->status == 1){
                        $premium->update([
                            'range' => 1,
                            'status_id' => 1,
                            'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                        ]);
                    }
                    elseif ($request->status == 2){
                        $premium->update([
                            'limit' => $this->addDate(1,date('Y-m-d')),
                            'status_id' => 2
                        ]);
                    }
                }
            }
        }

        return redirect()->route('member.show',compact('member'));
    }

    private function updateDate($date,$premium)
    {
        $premium->update(['limit' => $date]);
    }

    private function canUpdateStatus($premium)
    {
        return strtotime(date('Y-m-d')) >= strtotime($premium->update_status);
    }
}
