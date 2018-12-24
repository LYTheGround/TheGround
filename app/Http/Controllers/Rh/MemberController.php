<?php

namespace App\Http\Controllers\Rh;

use App\City;
use App\Http\Requests\Premium\RangeRequest;
use App\Http\Requests\Premium\StatusRequest;
use App\Http\Requests\RH\InfoRequest;
use App\Member;
use App\Premium;
use Carbon\Carbon;
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
        $buys = $member->buys();
        //dd($buys);
        $sales = $member->sales();
        return view('rh.member.show',compact('member','buys','sales'));
    }

    public function params()
    {
        $member = auth()->user()->member;
        $identity = $member->identity(auth()->user());
        $cities = City::all();
        return view('rh.member.params',compact('member','cities','identity'));
    }

    public function updateParams(InfoRequest $request)
    {
        // update info
        $member = auth()->user()->member;
        $info = $member->info;
        $r = $request->all();
        $r['city_id'] = $request->city;
        // update face
        if(!is_null($request->file('face'))){
            if($info->face){
                Storage::disk('public')->delete($info->face);
            }
            $face = $request->file('face')->store('rh/users');
            $r['face'] = $face;
        }
        $info->update($r);
        $member->update($r);
        // update email
        $member->info->emails[0]->update(['email' => $request->email]);
        $member->info->tels[0]->update(['tel' => $request->tel]);
        // update tel
        // update identity

        auth()->user()->update([
            'login' => $r[$request->identity]
        ]);
        // update password
        if(!is_null($request->password)){
            $user = auth()->user();
            $user->password = bcrypt($request->password);
            $user->save();
        }
        session()->flash('status',trans('pages.rh.user.success_params'));
        return redirect()->route('member.show',compact('member'));
    }

    public function range(Member $member)
    {
        if($member->premium->status->status == 'active'){
            return view('rh.member.range',compact('member'));
        }
        else{
            if($member->premium->status->status == 'inactive'){
                session()->flash('danger',trans('pages.rh.user.range.range_inactive_danger'));
            }
            else{
                session()->flash('danger',trans('pages.rh.user.range.range_archived_danger'));
            }
            return back();
        }
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
        else{
            $date = $this->addDate($range,$premium->limit);
            $this->updateDate($date,$premium);
            $this->updateDate($date,$premium_company);
            $this->sold($range,$premium_company);
        }
        session()->flash('status',trans('pages.rh.user.range.add_success'));
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
            session()->flash('danger', trans('pages.rh.user.status.danger_pdg'));
            return redirect()->route('member.show',compact('member'));
        }
        if($this->canUpdateStatus($member->premium)){
            return view('rh.member.status',compact('member'));
        }
        session()->flash('danger', trans('pages.rh.user.status.danger_bloque',['value' => Carbon::parse($member->premium->update_status)->format('d-m-Y')]));
        return redirect()->route('member.show',compact('member'));

    }

    public function updateStatus(StatusRequest $request, Member $member,Premium $premium)
    {
        $status = $request->status;
        if($this->canUpdateStatus($member->premium)){
            $premium->updateStatusMember($status,$member->company,$member->premium);
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
