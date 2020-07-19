<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTacheRequest extends FormRequest
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
            'type' => 'nullable|in:mission,sondage,enquete',
            'titre' => 'nullable|string',
            'description' => 'nullable|string',
            'nombre_personnes' => 'nullable|integer',
            'prix_personne' => 'nullable|numeric',
            'preuve_validite' => 'nullable|in:video,image,memo,rien',
            'tranche_age_cible' => 'nullable|string',
            'sexe_cible' => 'in:homme,femme,les deux',
            'region_cible' => 'nullable|string',
            'domaine' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'rayon' => 'nullable|numeric',
            'image_tache' => 'nullable|image',
        ];
    }
}
