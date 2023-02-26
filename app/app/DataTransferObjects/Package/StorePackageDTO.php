<?php

namespace App\DataTransferObjects\Package;

use Illuminate\Support\Arr;

class StorePackageDTO
{
    public readonly int $package_number;
    public readonly string $name;
    public readonly string $size;
    public readonly string $status;
    public readonly string $sender_email;
    public readonly string $recipient_email;
    

    public function __construct(public readonly array $packageData)
    {
        $this->package_number = Arr::get($packageData, 'package_number');
        $this->name = Arr::get($packageData, 'name');
        $this->size = Arr::get($packageData, 'size');
        $this->status = Arr::get($packageData, 'status');
        $this->sender_email = Arr::get($packageData, 'sender_email');
        $this->recipient_email = Arr::get($packageData, 'recipient_email');
    }
}