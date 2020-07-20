<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutReponseTacheRequest;
use App\Http\Requests\UpdateReponseTacheRequest;
use App\ReponseTache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReponseTacheController extends Controller
{
    public function index()
    {
        $reponse_taches = ReponseTache::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $reponse_taches);
        return response()->json($response, 200);
    }

    public function store(AjoutReponseTacheRequest $request)
    {
        $input = $request->all();
        $input['etat'] = "en attente";      
        if($request->hasFile('lien_preuve')){
            $path = Storage::putFile('ReponseTachePreuves', $request->logo);
            $input['lien_preuve'] = $path;
        }
        else {
            $input['lien_preuve'] ="";
        }
        $new_reponse_tache = ReponseTache::create($input);
        $reponse_tache_save = $new_reponse_tache->save();
        if($reponse_tache_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_reponse_tache);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $reponse_tache = ReponseTache::find($id);
        if ($reponse_tache == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'reponse_tache introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'reponse_tache disponible', $reponse_tache);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateReponseTacheRequest $request,$id){
        $reponse_tache= ReponseTache::find($id);
        if($reponse_tache!=null){
        {
            if($request->has('nom')) {
            $reponse_tache->nom = $request->nom;
            }
            if($request->has('prenom')) {
            $reponse_tache->prenom = $request->prenom;
            }
            if($request->has('lieu_residence')){
                $reponse_tache->lieu_residence = $request->lieu_residence;
            }
            if($request->has('age')){
                $reponse_tache->age = $request->age;
            }
            if($request->has('situation_familiale')) {
                $reponse_tache->situation_familiale = $request->situation_familiale;
            }
            if($request->has('latitude')){
                $reponse_tache->latitude = $request->latitude;
            }
            if($request->has('longitude')){
                $reponse_tache->longitude = $request->longitude;
            }
            $reponse_tache_save = $reponse_tache->save();
            if ($reponse_tache_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $reponse_tache);
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
        $reponse_tache = ReponseTache::find($id);
        if ($reponse_tache == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec reponse_tache Introuvable', null);
            return response()->json($response, 400);
        } else {
            $reponse_tache_delete = $reponse_tache->delete();
            if ($reponse_tache_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $reponse_tache);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
