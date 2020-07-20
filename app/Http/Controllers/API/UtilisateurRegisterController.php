<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilisateurRegisterRequest;
use App\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurRegisterController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:utilisateur-api');
    }
    public function register(UtilisateurRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);    
        $input['domaine'] = "";
        $input['region']="";
        $input['image_profil']="";
        $utilisateur = Utilisateur::create($input);
        $success['token'] =  $utilisateur->createToken('My Utilisateur')->accessToken;
        $success['name'] =  $utilisateur->nom;
        $utilisateur_save = $utilisateur->save();
        if($utilisateur_save){
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['erreur' => null],400);
        }
    }
}
