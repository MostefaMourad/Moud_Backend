<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AjoutReponseRequest;
use App\Http\Requests\AjoutVerificationRequest;
use App\Http\Requests\AjoutVerRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Question;
use App\ReponseON;
use App\ReponseTache;
use App\ReponseWH;
use App\Tache;
use App\Utilisateur;
use App\Verification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function taches() 
    { 
        $user = Auth::user();
        $taches = DB::table('taches')->where([['region_cible',$user->region],['domaine',$user->domaine]])->get();
        if($taches!=null){
             $response = APIHelpers::createAPIResponse(false, 200, 'Taches Trouves', $taches);
             return response()->json($response, 200);
        }
        else{
             $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
             return response()->json($response, 400);
        }
    }
    public function show($id)
    {
        $tache = Tache::find($id);
        $questions = $tache->questions;
        $tache->questions = $questions;
        if ($tache == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'tache introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'tache disponible', $tache);
        }
        return response()->json($response, 200);
    }

    public function store(AjoutReponseRequest $request)
    {
        $user = Auth::user(); 
        $input = $request->all();   
        $input['etat'] = "en attente";
        $input['utilisateur_id'] = $user->id;
        $input['domaine'] = $user->domaine; 
        if($request->hasFile('lien_preuve')){
            $path = Storage::putFile('ReponseTachePreuves', $request->lien_preuve);
            $input['lien_preuve'] = $path;
            dd($path);
        }
        else {
            $input['lien_preuve'] ="";
        }
        $new_reponse_tache = ReponseTache::create($input);
        foreach ($input['reponses'] as $reponse) {
            $question = Question::find($reponse['question_id']);
            if($question->type=="wh"){
                $rep = new ReponseWH();
                $rep->reponse = $reponse['reponse'];
                $rep->question_id = $reponse['question_id'];
                $rep->reponse_tache_id = $new_reponse_tache->id;
                $rep->save();
            }
            else{
                $rep = new ReponseON();
                $rep->reponse =boolval($reponse['reponse']);
                $rep->question_id = $reponse['question_id'];
                $rep->reponse_tache_id = $new_reponse_tache->id;
                $rep->save();
            }
        }
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
    public function verifications() 
    { 
        $user = Auth::user();
        $verifications = DB::table('reponse_taches')->where([['etat','en attente'],['domaine',$user->domaine],['utilisateur_id','<>',$user->id]])->get();
        if($verifications!=null){
            $taches = [];
            $i=0;
            foreach ($verifications as $verification) {
                $taches[$i] = Tache::find($verification->tache_id);
                $taches[$i]->reponse_id = $verification->id;
                $i++;
            }
             $response = APIHelpers::createAPIResponse(false, 200, 'Taches Trouves', $taches);
             return response()->json($response, 200);
        }
        else{
             $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
             return response()->json($response, 400);
        }
    }
    public function showReponse($id)
    {
        $tache = ReponseTache::find($id);
        $reponseson = $tache->reponseson;
        $responsewh = $tache->reponseswh;
        unset($tache->reponseson);
        unset($tache->reponseswh);
        $tache->reponses = $reponseson->concat($responsewh);
        if ($tache == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'tache introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'tache disponible', $tache);
        }
        return response()->json($response, 200);
    }
    public function storeValid(AjoutVerRequest $request)
    {
        $user = Auth::user(); 
        $input = $request->all();
        $input['utilisateur_id'] = $user->id;
        $new_reponse_tache = Verification::create($input);
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

}
