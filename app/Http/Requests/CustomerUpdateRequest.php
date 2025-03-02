<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'customer_name'  => 'sometimes|string',
            'customer_email' => [
                'sometimes',
                'email',
                Rule::unique('customers')->ignore(optional($this->customer)->id),
            ],
            'customer_phone' => [
                'sometimes',
                'digits:11',
                Rule::unique('customers')->ignore(optional($this->customer)->id),
            ],
            'customer_cv'    => 'sometimes|nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
