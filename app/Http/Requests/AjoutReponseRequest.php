<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutReponseRequest extends FormRequest
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
            'tache_id' => 'required|integer|exists:taches,id',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'lieu_residence' => 'required|string',
            'age' => 'required|integer',
            'situation_familiale' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'lien_preuve' => 'nullable|mimes:jpeg,bmp,png,flv,mp4,avi,wmv,m3u8,ts,3gp,avi,wmv,application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'reponses' => 'nullable|array',
        ];
    }
}
