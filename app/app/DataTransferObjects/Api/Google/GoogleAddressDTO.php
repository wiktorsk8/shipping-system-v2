<?php

namespace App\DataTransferObjects\Api\Google;


class GoogleAddressDTO
{
    public function __construct(
        public readonly string $street_name,
        public readonly string $street_number,
        public readonly string $postal_code,
        public readonly string $city,
    ) {}
}
