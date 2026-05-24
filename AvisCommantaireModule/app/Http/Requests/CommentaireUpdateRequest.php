<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentaireUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $avis = $this->route('avis');
        $user = $this->route('user');

        $this->merge([
            'avis_id' => is_object($avis) ? $avis->id : $avis,
            'user_id' => is_object($user) ? $user->id : $user,
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'avis_id' => ['required', 'integer', 'exists:avis,id'],
            'contenu' => ['required', 'string', 'min:5', 'max:2000'],
            'isLitige' => ['required', 'boolean'],
            'isVisible' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L’identifiant de l’utilisateur est requis.',
            'user_id.integer' => 'L’identifiant de l’utilisateur doit être un nombre entier.',
            'user_id.exists' => 'L’utilisateur sélectionné est invalide.',
            'avis_id.required' => 'L’identifiant de l’avis est requis.',
            'avis_id.integer' => 'L’identifiant de l’avis doit être un nombre entier.',
            'avis_id.exists' => 'L’avis sélectionné est invalide.',
            'contenu.required' => 'Le contenu est requis.',
            'contenu.string' => 'Le contenu doit être du texte.',
            'contenu.min' => 'Le contenu doit comporter au moins :min caractères.',
            'contenu.max' => 'Le contenu ne doit pas dépasser :max caractères.',
            'isLitige.required' => 'Le statut litige est requis.',
            'isLitige.boolean' => 'Le statut litige doit être vrai ou faux.',
            'isVisible.required' => 'Le statut visibilité est requis.',
            'isVisible.boolean' => 'Le statut visibilité doit être vrai ou faux.',
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
