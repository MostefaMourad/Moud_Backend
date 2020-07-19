<?php

namespace App\Http\Controllers;

use App\Entreprise;
use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $entreprises);
        return response()->json($response, 200);
    }

    public function store(AjoutEntrepriseRequest $request)
    {
        $new_entreprise = new Entreprise();
        $new_entreprise->nom = $request->nom;
        $new_entreprise->type = $request->type;
        $new_entreprise->description = $request->description;
        if($request->has('quantite')){
            $new_entreprise->quantite = $request->quantite;
        }
        else{
            $new_entreprise->quantite = 0;
        }
        $entreprise_save = $new_entreprise->save();
        if($entreprise_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_entreprise);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $entreprise = Entreprise::find($id);
        if ($entreprise == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'entreprise introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'entreprise disponible', $entreprise);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateEntrepriseRequest $request,$id){
        $entreprise= Entreprise::find($id);
        if($entreprise!=null){
        {
            if($request->has('nom')) {
            $entreprise->nom = $request->nom;
            }
            if($request->has('type')) {
            $entreprise->type = $request->type;
            }
            if($request->has('description')){
                $entreprise->description = $request->description;
            }
            if($request->has('quantite')){
                $entreprise->quantite = $request->quantite;
            }
            $entreprise_save = $entreprise->save();
            if ($entreprise_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $entreprise);
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
        $entreprise = Entreprise::find($id);
        if ($entreprise == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec entreprise Introuvable', null);
            return response()->json($response, 400);
        } else {
            $entreprise_delete = $entreprise->delete();
            if ($entreprise_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $entreprise);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
