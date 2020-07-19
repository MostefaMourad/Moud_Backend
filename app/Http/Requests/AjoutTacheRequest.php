<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutTacheRequest extends FormRequest
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
            'type' => 'required|in:mission,sondage,enquete',
            'titre' => 'required|string',
            'description' => 'required|string',
            'nombre_personnes' => 'required|integer',
            'prix_personne' => 'required|numeric',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'preuve_validite' => 'required|in:video,image,memo,rien',
            'tranche_age_cible' => 'required|string',
            'sexe_cible' => 'in:homme,femme,les deux',
            'region_cible' => 'required|string',
            'domaine' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'rayon' => 'required|numeric',
            'image_tache' => 'nullable|image',
        ];
    }
}
