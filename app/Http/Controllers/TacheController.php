<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutTacheRequest;
use App\Http\Requests\UpdateTacheRequest;
use App\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TacheController extends Controller
{
    public function index()
    {
        $taches = Tache::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $taches);
        return response()->json($response, 200);
    }

    public function store(AjoutTacheRequest $request)
    {
        $input = $request->all();
        if($request->hasFile('image_tache')){
            $path = Storage::putFile('ImagesTaches', $request->image_tache);
            $input['image_tache'] = $path;
        }
        else {
            $input['image_tache'] ="";
        }
        $new_tache = tache::create($input);
        $tache_save = $new_tache->save();
        if($tache_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_tache);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $tache = Tache::find($id);
        if ($tache == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'tache introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'tache disponible', $tache);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateTacheRequest $request,$id){
        $tache= Tache::find($id);
        if($tache!=null){
        {
            if($request->has('type')) {
            $tache->type = $request->type;
            }
            if($request->has('titre')) {
            $tache->titre = $request->titre;
            }
            if($request->has('description')){
                $tache->description = $request->description;
            }
            if($request->has('nombre_personnes')){
                $tache->nombre_personnes = $request->nombre_personnes;
            }
            if($request->has('prix_personne')) {
                $tache->prix_personne = $request->prix_personne;
            }
            if($request->has('preuve_validite')){
                $tache->preuve_validite = $request->preuve_validite;
            }
            if($request->has('tranche_age_cible')){
                $tache->tranche_age_cible = $request->tranche_age_cible;
            }
            if($request->has('sexe_cible')) {
            $tache->sexe_cible = $request->sexe_cible;
            }
            if($request->has('region_cible')) {
            $tache->region_cible = $request->region_cible;
            }
            if($request->has('nbr_reponses_valides')){
                $tache->nbr_reponses_valides = $request->nbr_reponses_valides;
            }
            if($request->has('domaine')){
                $tache->domaine = $request->domaine;
            }
            if($request->has('latitude')) {
                $tache->latitude = $request->latitude;
            }
            if($request->has('longitude')){
                $tache->longitude = $request->longitude;
            }
            if($request->has('rayon')){
                $tache->rayon = $request->rayon;
            }
            if($request->hasFile('image_tache')){
                $path = Storage::putFile('tachesLogos', $request->image_tache);
                $tache->image_tache = $path;
            }
            $tache_save = $tache->save();
            if ($tache_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $tache);
                return response()->json($response, 200);
            } 
            else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
        }else{
            $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
            return response()->json($response, 400); 
        }
    }
    
    public function destroy($id)
    {
        $tache = Tache::find($id);
        if ($tache == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec tache Introuvable', null);
            return response()->json($response, 400);
        } else {
            $tache_delete = $tache->delete();
            if ($tache_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $tache);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
