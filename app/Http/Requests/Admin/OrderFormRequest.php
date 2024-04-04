<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'CustomerID'=>[
                'integer',
                'nullable'
            ],
            'EmployeeID'=>[
                'integer',
                'nullable'
            ],
            'PaymentID'=>[
                'integer',
                'nullable'
            ],
            'address'=>[
                'string',
            ],
            'status'=>[
                'integer',
                'nullable'
            ],
            'totalPrice'=>[
                'integer',
                'nullable'
            ],
            'product_chose'=>[
                'integer',
            ],
        ];
    }
}
