<?php

namespace App\Services\Address;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Package;
use App\Http\Services\GoogleApiService;

class AddressService
{
    public function store(Request $request, Package $package){
        return  Address::create([
            'package_id' => $package->id,
            'street_name' => $request->street_name,
            'street_number' => $request->street_number,
            'flat_number' => $request->flat_number,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'coordinates' => GoogleApiService::addressToCoordinates($request->senders_full_address),
            'recipients_street_name' => $request->recipients_street_name,
            'recipients_street_number' => $request->recipients_street_number,
            'recipients_flat_number' => $request->recipients_flat_number,
            'recipients_postal_code' => $request->recipients_postal_code,
            'recipients_city' => $request->recipients_city,
            'recipients_coordinates' => GoogleApiService::addressToCoordinates($request->recipients_full_address)
        ]);
    }
}