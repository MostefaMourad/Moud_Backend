<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $utilisateurs);
        return response()->json($response, 200);
    }



    public function show($id)
    {
        $utilisateur = Utilisateur::find($id);
        if ($utilisateur == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'utilisateur introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'utilisateur disponible', $utilisateur);
        }
        return response()->json($response, 200);
    }

    
    public function destroy($id)
    {
        $utilisateur = Utilisateur::find($id);
        if ($utilisateur == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec utilisateur Introuvable', null);
            return response()->json($response, 400);
        } else {
            $utilisateur_delete = $utilisateur->delete();
            if ($utilisateur_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $utilisateur);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
