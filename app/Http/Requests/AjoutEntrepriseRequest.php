<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutEntrepriseRequest extends FormRequest
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
            'nom' => 'required|string|unique:entreprises,nom',
            'description' => 'required|string',
            'email' => 'required|email|unique:entreprises,email',
            'domaine' => 'required|string',
            'telephone' => 'required|string',
            'fax' => 'required|string',
            'adresse' => 'required|string',
            'logo' => 'nullable|image',
        ];
    }
}
