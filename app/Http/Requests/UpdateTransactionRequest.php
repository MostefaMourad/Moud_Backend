<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'etat' => 'nullable|in:en attente,complete,annule',
            'type' => 'nullable|in:ccp,flexy',
            'montant_courant' => 'nullable|numeric',
            'montant_restant' => 'nullable|numeric',
        ];
    }
}
