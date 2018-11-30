<?php

namespace App\Http\Controllers\Rh;

use App\City;
use App\Http\Requests\Rh\PositionStoreRequest;
use App\Info;
use App\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info_box;

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
     * @param PositionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PositionStoreRequest $request)
    {
        // uploader l'image faciale de position si il existe
        $data = $request->all();
        if($request->face){
            $data = array_merge($data, ['face' => $request->file('face')->store('positions')]);
        }
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
        $data = $this->validate(request(), ['first_name' => '', 'last_name' => '', 'address' => '', 'sex' => '', 'city_id' => 'required', 'birth' => '', 'cin' => 'nullable|unique:infos,cin,' . $position->info->id, 'facial' => '',]);
        $position->info->update($data);
        $dataPosition['position'] = str_slug(request()->first_name . ' ' . request()->last_name . ' ' . $position->info->id, '-');
        $position->position = $dataPosition['position'];
        $position->save();
        if (isset($position->info->emails[0]->id)) {
            $datam = $this->validate(request(), ['email' => 'unique:emails,email,' . $position->info->emails[0]->id]);
            $position->info->emails()->update($datam);
        } else {
            if (request()->email) {
                $datam = $this->validate(request(), ['email' => '']);
                $position->info->emails()->create($datam);
            }
        }
        if (isset($position->info->tels[0]->id)) {
            $datat = $this->validate(request(), ['tel' => '']);
            $position->info->tels()->update($datat);
        } else {
            if (request()->tel) {
                $datat = $this->validate(request(), ['tel' => '']);
                $position->info->tels()->create($datat);
            }
        }
        if ($request->file('face')) {
            if (file_exists('storage/' . $position->info->face)) {
                @unlink('storage/' . $position->info->face);
            }
            $position->info->update([
                'face'  => $request->file('face')->store('positions'),
            ]);
        }
        session()->flash('status', __('pages.position.update_success'));
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
}
