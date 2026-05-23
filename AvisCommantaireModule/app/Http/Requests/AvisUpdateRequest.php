<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $artisan = $this->route('artisan');
        $user = $this->route('user');

        $this->merge([
            'artisan_id' => is_object($artisan) ? $artisan->id : $artisan,
            'user_id' => is_object($user) ? $user->id : $user,
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'artisan_id' => ['required', 'integer', 'exists:users,id'],
            'contenu' => ['required', 'string', 'min:10', 'max:2000'],
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
            'artisan_id.required' => 'L’identifiant de l’artisan est requis.',
            'artisan_id.integer' => 'L’identifiant de l’artisan doit être un nombre entier.',
            'artisan_id.exists' => 'L’artisan sélectionné est invalide.',
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
}
