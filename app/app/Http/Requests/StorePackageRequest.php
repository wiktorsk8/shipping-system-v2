<?php

namespace App\Http\Requests;

use App\Models\Package;
use App\Helpers\Enums\PackageStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StorePackageRequest extends FormRequest
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
            'name' => ['required'],
            'size' => ['required', Rule::in('XS', 'S', 'M', 'L', 'XL')],
            'status' => ['required', new Enum(PackageStatus::class)],
            'recipient_email' => ['required'],
            'sender_email' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'street_number' => ['required'],
            'flat_number' => ['nullable'],
            'recipient_city' => ['required'],
            'recipient_postal_code' => ['required'],
            'recipient_street_name' => ['required'],
            'recipient_flat_number' => ['nullable'],
            'recipient_street_number' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => PackageStatus::IN_PREPARATION->value,
            'sender_email' => Auth::user()->email,
        ]);
    }
}
