<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilRequest;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UtilisateurController extends Controller
{
    public function profil() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200); 
    }
    public function update(UpdateProfilRequest $request) 
    { 
        $usr = Auth::user();
        $utilisateur = Utilisateur::find($usr->id); 
        if($utilisateur!=null){
        {
            if($request->has('nom')) {
            $utilisateur->nom = $request->nom;
            }
            if($request->has('email')) {
            $utilisateur->email = $request->email;
            }
            if($request->has('prenom')){
                $utilisateur->prenom = $request->prenom;
            }
            if($request->has('domaine')){
                $utilisateur->domaine = $request->domaine;
            }
            if($request->has('region')) {
                $utilisateur->region = $request->region;
            }
            if($request->hasFile('image_profil')){
                $path = Storage::putFile('utilisateursProfils', $request->image_profil);
                $utilisateur->image_profil = $path;
            }
            $utilisateur_save = $utilisateur->save();
            if ($utilisateur_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $utilisateur);
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
        }; 
    }  
}
