<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutVerificationRequest;
use App\Http\Requests\UpdateVerificationRequest;
use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function index()
    {
        $verifications = Verification::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $verifications);
        return response()->json($response, 200);
    }

    public function store(AjoutVerificationRequest $request)
    {
        $input = $request->all();
        $new_verification = Verification::create($input);
        $verification_save = $new_verification->save();
        if($verification_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_verification);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $verification = Verification::find($id);
        if ($verification == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'verification introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'verification disponible', $verification);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateVerificationRequest $request,$id){
        $verification= Verification::find($id);
        if($verification!=null){
        {
            if($request->has('note')) {
            $verification->note = $request->note;
            }
            if($request->has('commentaire')) {
            $verification->commentaire = $request->commentaire;
            }
            $verification_save = $verification->save();
            if ($verification_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $verification);
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
        $verification = Verification::find($id);
        if ($verification == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec verification Introuvable', null);
            return response()->json($response, 400);
        } else {
            $verification_delete = $verification->delete();
            if ($verification_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $verification);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
