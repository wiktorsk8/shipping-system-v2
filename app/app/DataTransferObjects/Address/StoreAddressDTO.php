<?php

namespace App\DataTransferObjects\Address;

use Illuminate\Support\Arr;

class StoreAddressDTO
{
    public readonly int $package_id;
    public readonly string $street_name;
    public readonly string $street_number;
    public readonly ?string $flat_number;
    public readonly string $postal_code;
    public readonly string $city;

    public readonly string $recipient_street_name;
    public readonly string $recipient_street_number;
    public readonly ?string $recipient_flat_number;
    public readonly string $recipient_postal_code;
    public readonly string $recipient_city;

    public function __construct(public readonly array $addressData)
    {   
        

        $this->package_id = Arr::get($addressData, 'package_number');
        $this->street_name = Arr::get($addressData, 'street_name');
        $this->street_number = Arr::get($addressData, 'street_number');
        $this->flat_number = Arr::get($addressData, 'flat_number', null);
        $this->postal_code = Arr::get($addressData, 'postal_code');
        $this->city = Arr::get($addressData, 'city');

        $this->recipient_street_name = Arr::get($addressData, 'recipient_street_name');
        $this->recipient_street_number = Arr::get($addressData, 'recipient_street_number');
        $this->recipient_flat_number = Arr::get($addressData, 'recipient_flat_number', null);
        $this->recipient_postal_code = Arr::get($addressData, 'recipient_postal_code');
        $this->recipient_city = Arr::get($addressData, 'recipient_city');

        
    }
}