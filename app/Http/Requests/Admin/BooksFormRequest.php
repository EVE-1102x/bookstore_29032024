<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BooksFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:200'
            ],
            'price' => [
                'nullable',
                'integer'
            ],
            'image' => [
                'nullable',
                'image'
            ],
            'description' => [
                'nullable',
                'string',
                'max:200'
            ],
            'stock' => [
                'nullable',
                'integer'
            ],
            'CategoryID' => [
                'nullable',
                'integer'
            ],
            'AuthorID' => [
                'nullable',
                'integer'
            ],
            'PublisherID' => [
                'nullable',
                'integer'
            ]
        ];
    }
}
