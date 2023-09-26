<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateLesson extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('lessons')->ignore($this->lesson)
            ],
            'video' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('lessons')->ignore($this->lesson)
            ],
            'description' => [
                'nullable',
                'min:3',
                'max:999'
            ]
        ];
    }
}
