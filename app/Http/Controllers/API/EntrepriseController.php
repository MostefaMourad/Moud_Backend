<?php

namespace App\Http\Controllers\API;

use App\Entreprise;
use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Question;
use App\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200); 
    }
    public function taches(){
        $user = Auth::user();
        $entreprise = Entreprise::find($user->id);
        $taches = $entreprise->taches;
        $taches = $taches->filter(function ($tache) {
            if($tache->nombre_personnes==$tache->nbr_reponses_valides){
                return $tache;
            }
        })->values()->all();
        foreach ($taches as $tache) {
                unset($tache->entreprise_id);
                unset($tache->preuve_validite);
                unset($tache->tranche_age_cible);
                unset($tache->sexe_cible);
                unset($tache->latitude);
                unset($tache->longitude);
                unset($tache->rayon);
                unset($tache->nbr_reponses_valides);
        }
        if($taches!=null){
            $response = APIHelpers::createAPIResponse(false, 201, 'Vos tâches',collect($taches));
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur', null);
            return response()->json($response, 201);
        }
    }
    public function tache($id){
        $user = Auth::user();
        $tache = Tache::find($id);
        if($tache->entreprise_id==$user->id && $tache->nombre_personnes==$tache->nbr_reponses_valides){
            $reponses_tache = $tache->reponsestache;
            $reponses_tache = $reponses_tache->filter(function ($rep) {
                if($rep->etat=="accepte"){
                    $reponseson = $rep->reponseson;
                    $responsewh = $rep->reponseswh;
                    unset($rep->reponseson);
                    unset($rep->reponseswh);
                    $reponses = $reponseson->concat($responsewh);
                    $reponses = $reponses->filter(function ($repp) {
                        $quest = Question::find($repp->question_id);
                        $repp->question = $quest->question;
                        unset($repp->question_id);
                        unset($repp->reponse_tache_id);
                        return $repp;
                    })->values()->all();
                    $rep->reponses = $reponses;
                    return $rep;
                }
            })->values()->all();
            $response = APIHelpers::createAPIResponse(false, 201, 'Vos données',$reponses_tache);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur', null);
            return response()->json($response, 201);
        }
    }
}
