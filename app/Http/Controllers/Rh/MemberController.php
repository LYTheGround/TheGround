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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{

    /**
     * la liste des membres de ma compagnie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $members = auth()->user()->member->company->members;
        return view('rh.member.index',compact('members'));
    }

    /**
     * profile de member.
     * je suis autorisé de voir les profiles des members de ma compagnie seulement.
     *
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Member $member)
    {
        $this->authorize('view',$member);
        $buys = $member->buys();
        $sales = $member->sales();
        return view('rh.member.show',compact('member','buys','sales'));
    }

    /**
     * Formulaire pour Modifier mes info's.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function params()
    {
        $member = auth()->user()->member;
        $identity = $member->identity(auth()->user());
        $cities = City::all();
        return view('rh.member.params',compact('member','cities','identity'));
    }

    /**
     * Modifier mes info's.
     * envoi une notification aux autre membre de ma compagnie
     * en les informent que j'ai mis ajour mes info's.
     * @param InfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        // update tel
        $member->info->tels[0]->update(['tel' => $request->tel]);
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

    /**
     * Form pour modifier le range du member
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * Modifier le range d'abonnement de member
     * en suivant la procédure
     * @param RangeRequest $request
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Gestionnaire de date pour ajouté les jours de range
     * @param $range
     * @param $date
     * @return string
     */
    private function addDate($range, $date)
    {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'. $range .'D')); // P1D means a period of 1 day
        return  $date->format('Y-m-d');
    }

    /**
     * Modifier le nombre de range
     * @param $range
     * @param $premium
     * @return mixed
     */
    private function addRange($range, $premium)
    {
        return $premium->update(['range' => $range]);
    }

    /**
     * Modifier le sold de la compagnie.
     * @param $range
     * @param $premium
     * @return mixed
     */
    private function sold($range, $premium)
    {
        return $premium->update(['sold' => $premium->sold - $range]);
    }

    /**
     * Formulaire pour changer le status d'un compte
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * Mis ajour le status de ce member
     * @param StatusRequest $request
     * @param Member $member
     * @param Premium $premium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(StatusRequest $request, Member $member,Premium $premium)
    {
        $status = $request->status;
        if($this->canUpdateStatus($member->premium)){
            $premium->updateStatusMember($status,$member->company,$member->premium);
        }
        return redirect()->route('member.show',compact('member'));
    }

    /**
     * Modifier la date limit.
     * @param $date
     * @param $premium
     */
    private function updateDate($date,$premium)
    {
        $premium->update(['limit' => $date]);
    }

    /**
     * Voir si en peux modifier le status en vérifiant la update_status
     * @param $premium
     * @return bool
     */
    private function canUpdateStatus($premium)
    {
        return strtotime(date('Y-m-d')) > strtotime($premium->update_status);
    }
}
