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
            'package_number' => ['required'],
            'name' => ['required'],
            'size' => ['required', Rule::in('XS', 'S', 'M', 'L', 'XL')],
            'status' => ['required', new Enum(PackageStatus::class)],
            'recipients_email' => ['required'],
            'senders_email' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'street_number' => ['required'],
            'flat_number' => ['nullable'],
            'recipients_city' => ['required'],
            'recipients_postal_code' => ['required'],
            'recipients_street_name' => ['required'],
            'recipients_flat_number' => ['nullable'],
            'recipients_street_number' => ['required'],
            'recipients_full_address' => ['required'],
            'senders_full_address' => ['required'],
        ];
    }

    private function convert_adress($data = []): string
    {
        $address = implode(' ', $data);
        return $address;
    }

    public function prepareForValidation()
    {

        $senders_full_address = [
            $this->street_name,
            $this->street_number,
            $this->flat_number,
            $this->postal_code,
            $this->city
        ];

        $recipients_full_address = [
            $this->recipients_street_name,
            $this->recipients_street_number,
            $this->recipients_flat_number,
            $this->recipients_postal_code,
            $this->recipients_city
        ];

        $this->merge([
            'status' => PackageStatus::IN_PREPARATION,
            'senders_email' => Auth::user()->email,
            'package_number' => Package::generate(Auth::user()->id, $this->name),
            'senders_full_address' => $this->convert_adress($senders_full_address),
            'recipients_full_address' => $this->convert_adress($recipients_full_address),
        ]);
    }
}
