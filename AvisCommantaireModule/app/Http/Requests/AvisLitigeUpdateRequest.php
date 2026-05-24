<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class AvisLitigeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $artisan = $this->route('artisan');
        $avis = $this->route('avis');

        $this->merge([
            'artisan_id' => is_object($artisan) ? $artisan->id : $artisan,
            'avis_id' => is_object($avis) ? $avis->id : $avis,
        ]);
    }

    public function rules(): array
    {
        return [
            'artisan_id' => ['required', 'integer', 'exists:users,id'],
            'avis_id' => ['required', 'integer', 'exists:avis,id'],
            'contenu' => ['required', 'string', 'min:10', 'max:2000'],
            'isResolu' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'artisan_id.required' => 'L’identifiant de l’artisan est requis.',
            'artisan_id.integer' => 'L’identifiant de l’artisan doit être un nombre entier.',
            'artisan_id.exists' => 'L’artisan sélectionné est invalide.',
            'avis_id.required' => 'L’identifiant de l’avis est requis.',
            'avis_id.integer' => 'L’identifiant de l’avis doit être un nombre entier.',
            'avis_id.exists' => 'L’avis sélectionné est invalide.',
            'contenu.required' => 'Le contenu est requis.',
            'contenu.string' => 'Le contenu doit être du texte.',
            'contenu.min' => 'Le contenu doit comporter au moins :min caractères.',
            'contenu.max' => 'Le contenu ne doit pas dépasser :max caractères.',
            'isResolu.required' => 'Le statut de résolution est requis.',
            'isResolu.boolean' => 'Le statut de résolution doit être vrai ou faux.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Échec de la validation des données.',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
