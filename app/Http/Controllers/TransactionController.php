<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Transaction;
class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $transactions);
        return response()->json($response, 200);
    }

    public function store(AjoutTransactionRequest $request)
    {
        $input = $request->all();
        $input['etat'] = "en attente";
        $new_transaction = Transaction::create($input);
        $transaction_save = $new_transaction->save();
        if($transaction_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_transaction);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'transaction introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'transaction disponible', $transaction);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateTransactionRequest $request,$id){
        $transaction= transaction::find($id);
        if($transaction!=null){
        {
            if($request->has('etat')) {
            $transaction->etat = $request->etat;
            }
            if($request->has('type')) {
            $transaction->type = $request->type;
            }
            if($request->has('montant_courant')){
                $transaction->montant_courant = $request->montant_courant;
            }
            if($request->has('montant_restant')){
                $transaction->montant_restant = $request->montant_restant;
            }
            $transaction_save = $transaction->save();
            if ($transaction_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $transaction);
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
        $transaction = Transaction::find($id);
        if ($transaction == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec transaction Introuvable', null);
            return response()->json($response, 400);
        } else {
            $transaction_delete = $transaction->delete();
            if ($transaction_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $transaction);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
