<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntrepriseRequest extends FormRequest
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
            'nom' => 'nullable|string|unique:entreprises,nom',
            'description' => 'nullable|string',
            'email' => 'nullable|email|unique:entreprises,email',
            'domaine' => 'nullable|string',
            'telephone' => 'nullable|string',
            'fax' => 'nullable|string',
            'adresse' => 'nullable|string',
            'logo' => 'nullable|image',
        ];
    }
}
