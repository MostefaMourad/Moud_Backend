<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutReponseWHRequest;
use App\Http\Requests\UpdateReponseWHRequest;
use App\ReponseWH;
use Illuminate\Http\Request;

class ReponseWHController extends Controller
{
    public function index()
    {
        $reponsewhs = ReponseWH::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $reponsewhs);
        return response()->json($response, 200);
    }

    public function store(AjoutReponseWHRequest $request)
    {
        $input = $request->all();
        $new_reponsewh = reponsewh::create($input);
        $reponsewh_save = $new_reponsewh->save();
        if($reponsewh_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_reponsewh);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $reponsewh = reponsewh::find($id);
        if ($reponsewh == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'reponsewh introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'reponsewh disponible', $reponsewh);
        }
        return response()->json($response, 200);
    }   

    public function update(UpdateReponseWHRequest $request,$id){
        $reponsewh= reponsewh::find($id);
        if($reponsewh!=null){
        {
            if($request->has('reponse')) {
            $reponsewh->reponse = $request->reponse;
            }
            $reponsewh_save = $reponsewh->save();
            if ($reponsewh_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $reponsewh);
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
        $reponsewh = reponsewh::find($id);
        if ($reponsewh == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec reponsewh Introuvable', null);
            return response()->json($response, 400);
        } else {
            $reponsewh_delete = $reponsewh->delete();
            if ($reponsewh_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $reponsewh);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
