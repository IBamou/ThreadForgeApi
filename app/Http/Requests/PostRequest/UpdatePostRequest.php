<?php

namespace App\Http\Requests\PostRequest;

use App\Enums\PostStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string'],
            'hook_proposal' => ['sometimes', 'nullable', 'string', 'max:500'],

            'body_points' => ['sometimes', 'nullable', 'array'],
            'body_points.*' => ['string', 'max:1000'],

            'suggested_hashtags' => ['sometimes', 'nullable', 'array'],
            'suggested_hashtags.*' => ['string', 'max:50'],

            'technical_readability_score' => [
                'sometimes',
                'nullable',
                'integer',
                'min:0',
                'max:100',
            ],

            'tone_compliance_justification' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'status' => [
                'sometimes',
                'string',
                Rule::enum(PostStatus::class),
            ],
        ];
    }
}
