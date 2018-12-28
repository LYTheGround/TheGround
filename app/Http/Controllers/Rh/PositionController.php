<?php

namespace App\Http\Controllers\Rh;

use App\City;
use App\Info;
use App\Position;
use App\Rules\BirthRule;
use App\Rules\SexRule;
use App\Rules\TelRule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Les Positions sont les membres qui occupe des poste dans la compagnie, et qui n'ont pas
 * de compte dans cette App
 *
 * Class PositionController
 * @package App\Http\Controllers\Rh
 */
class PositionController extends Controller
{

    /**
     * <p>
     * Liste des positions de ma compagnie. <br/>
     * En cas de changement de la maquette actuel Merci de penser a vérifié la limite
     * des résultats.
     * </p>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // tous les membres peuvent voire toutes les positions de leurs compagnie
        // récupéré toutes les positions de ma compagnie
        $positions = auth()->user()->member->company->positions;
        // la limit des résultats est la préoccupation de la template actuel
        // returner la vus "index" de position en transmettant tous les positions
        $cities = City::all();
        return view('rh.position.index', compact('positions','cities'));
    }

    /**
     * formulaire de création des positions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // tous les membre peuvent créer des positions
        // trouvez toutes les villes dans la db
        $cities = City::all();
        // return la vus "create" en transmettant les villes au formulaire
        return view('rh.position.create', compact('cities'));
    }

    /**
     * créer une nouvel position dans ma compagne
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $v = $this->validated($request);
        if($v->fails()){
            return redirect()
                ->route('position.create')
                ->withErrors($v)
                ->withInput();
        }
        // uploader l'image faciale de position si il existe
        $data = $request->all();
        if($request->face){
            $data = array_merge($data, ['face' => $request->file('face')->store('positions')]);
        }
        $data = array_merge($data, ['city_id' => $request->city]);
        // créer la position
        $info = Info::create($data);
        $info->emails()->create(['email' => $data['email'], 'default' => 1]);
        $info->tels()->create(['tel' => $data['tel'], 'default' => 1]);
        $position = $info->position()->create([
            'position' => str_slug($info->first_name . ' ' . $info->last_name . ' ' . $info->id, '-'),
            'member_id' => auth()->user()->member->id,
            'company_id' => auth()->user()->member->company->id
        ]);
        // redirect vers le profil de position just créer
        return redirect()->route('position.show',compact('position'));
    }

    /**
     * le profil de position actuel
     * @param Position $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Position $position)
    {
        // vérifié si le membre a le droit de voire ce profil
        $this->authorize('view',$position);
        // trouvez toutes les villes dans la BD pour la bordure de modification
        $cities = City::all();
        // return la vus "show" en transmettant les villes et la position actuel
        return view('rh.position.show', compact('position','cities'));
    }

    /**
     * @param Position $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Position $position)
    {
        // seul les membres de ma compagne qui peuvent modifié cette position
        $this->authorize('update',$position);
        $cities = City::all();
        return view('rh.position.edit', compact('position', 'cities'));
    }

    /**
     * @param Request $request
     * @param Position $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Position $position)
    {
        $this->authorize('update',$position);
        $validate = $this->validated($request);
        if($validate->fails()){
            return redirect()
                ->route('position.edit',compact('position'))
                ->withErrors($validate)
                ->withInput();
        }
        // update position
        $position->update(['position' => $request->position]);
        // update info
        $data = $request->all();
        $data = array_merge($data, ['city_id' => $request->city]);

        $position->info->update($data);
        // update email
        $position->info->emails[0]->update(['email' => $request->email]);
        // update tel
        $position->info->tels[0]->update(['tel' => $request->tel]);
        // update face
        if ($request->file('face')) {
            Storage::disk('public')->delete($position->info->face);
            $position->info->update([
                'face'  => $request->file('face')->store('positions'),
            ]);
        }
        session()->flash('status', __('pages.rh.position.edit_success'));
        return redirect()->route('position.show',compact('position'));
    }

    /**
     * @param Position $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Position $position)
    {
        $this->authorize('delete',$position);
        $position->info->emails()->delete();
        $position->info->tels()->delete();
        $position->info->delete();
        if($position->info->face){
            if (file_exists('storage/' . $position->info->face)) {
                @unlink('storage/' . $position->info->face);
            }
        }
        $position->delete();
        session()->flash('status', __('pages.position.delete_success'));
        return redirect()->route('position.index');
    }

    private function validated($request)
    {
        return Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:20',
            'address' => 'nullable|string|min:10|max:100',
            'sex' => ['required', 'string', new SexRule()],
            'city' => 'required|int|exists:cities,id',
            'birth' => ['required','date', new BirthRule()],
            'cin' => 'nullable|unique:infos,cin',
            'face' => 'nullable|mimes:png,jpg,jpeg,bmp',
            'email' => 'required|email',
            'tel' => ['required','min:10','max:10', new TelRule()],
        ]);
    }
}
