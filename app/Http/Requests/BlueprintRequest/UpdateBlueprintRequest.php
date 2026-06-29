<?php

namespace App\Http\Requests\BlueprintRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBluePrintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],

            'description' => ['sometimes', 'nullable', 'string'],

            'tone' => ['sometimes', 'string', 'max:50'],

            'target_platform' => [
                'sometimes',
                'string',
                'in:x,linkedin',
            ],

            'max_length' => [
                'sometimes',
                'integer',
                'min:50',
                'max:5000',
            ],

            'structure_rules' => ['sometimes', 'nullable', 'array'],
            'structure_rules.*' => ['string', 'max:100'],

            'style_rules' => ['sometimes', 'nullable', 'array'],
            'style_rules.*' => ['string', 'max:255'],

            'hashtag_strategy' => ['sometimes', 'nullable', 'array'],
            'hashtag_strategy.*' => ['string', 'max:100'],
        ];
    }
}
