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
            'flat_number' => 'required',
            'receivers_city' => 'required',
            'receivers_postal_code' => 'required',
            'receivers_street_name' => 'required',
            'receivers_flat_number' => 'required',
            'receivers_street_number' => 'required'
        ];
    }

    

    public function prepareForValidation()
    {
        // set deafult values before validation
        $this->merge([
            'status' => PackageStatus::PACKAGE_STATUS['In preparation'],
            'senders_id' => Auth::user()->id,
            'package_number' => PackageIdGenerator::generate(Auth::user()->id, request()->name),
            'receivers_id' => (int)$this->receivers_id
        ]);
    }

   
}
