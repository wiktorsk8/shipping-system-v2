<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrevalidateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:30'],
            'size' => ['required', Rule::in('XS', 'S', 'M', 'L', 'XL')],
            'recipients_email' => ['required', 'email'],
            'city' => ['required', 'max:30'],
            'postal_code' => ['required', 'size:6'],
            'street_name' => ['required', 'max:40'],
            'street_number' => ['required'],
            'flat_number' => ['nullable'],
            'recipients_city' => ['required', 'max:30'],
            'recipients_postal_code' => ['required', 'size:6'],
            'recipients_street_name' => ['required', 'max:40'],
            'recipients_street_number' => ['required'],
            'recipients_flat_number' => ['nullable'],

        ];
    }
}
