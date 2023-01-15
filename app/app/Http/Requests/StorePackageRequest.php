<?php

namespace App\Http\Requests;

use App\Helpers\Package\PackageIdGenerator;
use App\Helpers\Package\PackageStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


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
            'status' => ['required', Rule::in(PackageStatus::PACKAGE_STATUS)],
            'recipients_email' => ['required'],
            'senders_email' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'street_number' => ['required'],
            'flat_number' => ['required'],
            'recipients_city' => ['required'],
            'recipients_postal_code' => ['required'],
            'recipients_street_name' => ['required'],
            'recipients_flat_number' => ['required'],
            'recipients_street_number' => ['required'],
            'recipients_full_address' => ['required'],
            'senders_full_address' => ['required'],
        ];
    }

    private function convert_adress($data = [])
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
        
        // $this->merge([
        //     'status' => PackageStatus::PACKAGE_STATUS['In preparation'],
        //     'senders_email' => Auth::user()->email,
        //     'package_number' => PackageIdGenerator::generate(Auth::user()->id, request()->name),
        //     'senders_full_adress' => $this->convert_adress($senders_full_address),
        //     'recipient_full_adress' => $this->convert_adress($recipients_full_address),
        // ]);
    }
}
