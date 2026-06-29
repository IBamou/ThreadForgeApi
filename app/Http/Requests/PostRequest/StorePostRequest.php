<?php

namespace App\Http\Requests\PostRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:2','max:255'],
            'blueprint_id' => [
                'required',
                Rule::exists('blueprints', 'id')->where(function ($query) {
                    return $query->where('user_id', auth()->id())->whereNull('deleted_at');
                }),
            ],
            'input_id' => [
                'required',
                Rule::exists('inputs', 'id')->where(function ($query) {
                    return $query->whereNotNull('raw_input')->where('user_id', auth()->id())->whereNull('deleted_at');
                }),
            ],
        ];
    }
}
