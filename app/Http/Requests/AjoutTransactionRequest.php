<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'utilisateur_id' => 'required|integer|exists:utilisateurs,id',
            'type' => 'required|in:ccp,flexy',
            'montant_courant' => 'required|numeric',
            'montant_restant' => 'required|numeric',
        ];
    }
}
