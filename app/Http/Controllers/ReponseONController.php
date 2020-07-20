<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutReponseONRequest;
use App\Http\Requests\UpdateReponseONRequest;
use App\ReponseON;
use Illuminate\Http\Request;

class ReponseONController extends Controller
{
    public function index()
    {
        $reponseons = ReponseON::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $reponseons);
        return response()->json($response, 200);
    }

    public function store(AjoutReponseONRequest $request)
    {
        $input = $request->all();
        $new_reponseon = ReponseON::create($input);
        $reponseon_save = $new_reponseon->save();
        if($reponseon_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_reponseon);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $reponseon = ReponseON::find($id);
        if ($reponseon == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'reponseon introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'reponseon disponible', $reponseon);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateReponseONRequest $request,$id){
        $reponseon= ReponseON::find($id);
        if($reponseon!=null){
        {
            if($request->has('reponse')) {
            $reponseon->reponse = $request->reponse;
            }
            $reponseon_save = $reponseon->save();
            if ($reponseon_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $reponseon);
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
        $reponseon = ReponseON::find($id);
        if ($reponseon == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec reponseon Introuvable', null);
            return response()->json($response, 400);
        } else {
            $reponseon_delete = $reponseon->delete();
            if ($reponseon_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $reponseon);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
