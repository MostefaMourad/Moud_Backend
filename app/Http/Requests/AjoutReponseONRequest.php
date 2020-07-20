<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutReponseONRequest extends FormRequest
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
            'reponse' => 'required|boolean',
            'question_id' => 'required|integer|exists:questions,id',
            'reponse_tache_id' => 'required|integer|exists:reponse_taches,id',
        ];
    }
}
