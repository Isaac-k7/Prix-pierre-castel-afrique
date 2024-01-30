<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CandidatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        #pays_id
        # cv
        # identite
        # juridique_entreprise
        # juridique_commerciale
        # exercice
        # details_projet
        return [
            'pays_id' => ['required','int', 'max:100'],
            'cv' => ['required','mimes:pdf','max:2048'],
            'identite' => ['required','mimes:pdf','max:2048'],
            'juridique_entreprise' => ['required','mimes:pdf','max:2048'],
            'juridique_commerciale' => ['required','mimes:pdf','max:2048'],
            'exercice' => ['required','mimes:pdf','max:2048'],
            'details_projet' => ['required','mimes:pdf','max:2048']
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pays_id.required' => 'Veuilez sélectionner un pays.',
            'cv.required' => 'Ce champ :attribute est obligatoire.',
            'cv.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'cv.mimes' => 'Votre fichier :attribute doit être de type PDF.',
            'identite.required' => 'Ce champ :attribute est obligatoire.',
            'identite.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'identite.mimes' => 'Votre fichier :attribute doit être de type PDF recto verso sur une meme page.',
            'juridique_entreprise.required' => 'Ce champ :attribute est obligatoire.',
            'juridique_entreprise.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'juridique_entreprise.mimes' => 'Votre fichier :attribute doit être de type PDF.',
            'juridique_commerciale.required' => 'Ce champ :attribute est obligatoire.',
            'juridique_commerciale.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'juridique_commerciale.mimes' => 'Votre fichier :attribute doit être de type PDF.',
            'exercice.required' => 'Ce champ :attribute est obligatoire.',
            'exercice.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'exercice.mimes' => 'Votre fichier :attribute doit être de type PDF.',
            'details_projet.required' => 'Ce champ :attribute est obligatoire.',
            'details_projet.max' => 'Votre fichier :attribute ne doit pas dépasser 2M.',
            'details_projet.mimes' => 'Votre fichier :attribute doit être de type PDF.',
        ];
    }


     /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
    
        $errors = (new ValidationException($validator))->errors();
        $ok = implode('<br>', array_map(function ($entry) {
            return ($entry[key($entry)]);
          }, $errors));
        throw new HttpResponseException(redirect()->back()
        ->with('error',  $ok ));  

        
        
    }
}
