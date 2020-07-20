<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilisateurLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurLoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:utilisateur-api');
    }

    public function login(UtilisateurLoginRequest $request)
    {
        if (Auth::guard('utilisateur')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('utilisateur')->user();
            $success['token'] =  $user->createToken('My Utilisateur')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
