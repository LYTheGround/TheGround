<?php

namespace App\Http\Controllers\Token;

use App\Http\Requests\Token\TokenRequest;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    /**
     * Liste des jetons pour les nouveaux utilisateurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('token',auth()->user()->member);
        $tokens = auth()->user()->member->company->tokens;
        return view('token.index',compact('tokens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('token',auth()->user()->member);
        $company = auth()->user()->member->company;
        return view('token.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TokenRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TokenRequest $request)
    {
        $this->authorize('token',auth()->user()->member);
        // create new token
        $request->company->tokens()->create([
            'token'         => md5(sha1(rand())),
            'range'         => $request->range,
            'category_id'   => $request->category,
            'status_id'     => 1
        ]);
        // update sold company
        $premium = $request->company->premium;
        $premium->update([
            'sold' => $premium->sold - $request->range
        ]);
        session()->flash('status',__('pages.premium.token.created'));
        return redirect()->route('token.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function destroy(Token $token)
    {
        if($token->company_id == auth()->user()->member->company_id){
            $this->authorize('token',auth()->user()->member);
            $premium = $token->company->premium;
            $premium->update([
                'sold'  => $premium->sold + $token->range,
            ]);
            $token->delete();
            session()->flash('danger',__('pages.premium.token.deleted'));
        }
        else{
            session()->flash('status',__('pages.premium.token.cant_delete'));
        }
        return redirect()->route('token.index');
    }
}
