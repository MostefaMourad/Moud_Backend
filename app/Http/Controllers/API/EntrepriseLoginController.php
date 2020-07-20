<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrepriseLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseLoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:entreprise-api');
    }

    public function login(EntrepriseLoginRequest $request)
    {
        if(Auth::guard('entreprise')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('entreprise')->user();
            $success['token'] =  $user->createToken('My Entreprise')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
