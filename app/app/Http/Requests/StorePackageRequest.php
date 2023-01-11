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
            'name' => 'required',
            'size' => ['required', Rule::in('XS', 'S', 'M', 'L', 'XL')],
            'status' => ['required', Rule::in(PackageStatus::PACKAGE_STATUS)],
            'receivers_id' => 'required',
            'senders_id' => 'required',
            'package_number' => ['required'],
            'city' => 'required',
            'postal_code' => 'required',
            'street_name' => 'required',
            'street_number' => 'required',
            'flat_number' => 'nullable',
            'receivers_city' => 'required',
            'receivers_postal_code' => 'required',
            'receivers_street_name' => 'required',
            'receivers_flat_number' => 'nullable',
            'receivers_street_number' => 'required',
            'senders_address' => 'required',
            'receivers_address' => 'required'
        ];
    }

    private function convert_adress($data = []){
        $address = implode(' ', $data);
        return $address;
    }   

    public function prepareForValidation()
    {
        // set deafult values before validation
        $this->merge([
            'status' => PackageStatus::PACKAGE_STATUS['In preparation'],
            'senders_id' => Auth::user()->id,
            'package_number' => PackageIdGenerator::generate(Auth::user()->id, request()->name),
            'receivers_id' => (int)$this->receivers_id,
            'senders_address' => $this->convert_adress(
                ['city' => $this->city,
                'postal_code' => $this->postal_code,
                'street_name' => $this->street_name,
                'street_number' => $this->street_number,
                'flat_number' => $this->flat_number]
            ),
            'receivers_address' => $this->convert_adress(
                ['receivers_city' => $this->receivers_city,
                'receivers_postal_code' => $this->receivers_postal_code,
                'receivers_street_name' => $this->receivers_street_name,
                'receivers_street_number' => $this->receivers_street_number,
                'receivers_flat_number' => $this->receivers_flat_number]
            ),
        ]);
    }

   
}
