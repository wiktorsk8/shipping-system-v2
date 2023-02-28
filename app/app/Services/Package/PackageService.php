<?php

namespace App\Services\Package;

use App\DataTransferObjects\Package\StorePackageDTO;
use App\Events\PackageCreated;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageService
{
    public function store(StorePackageDTO $data): Package{
        return Package::create([
            'package_number' => Package::generate(Auth::user()->id, $data->name),
            'name' => $data->name,
            'status' => $data->status,
            'size' => $data->size,
            'recipient_email' => $data->recipient_email,
            'sender_email' => $data->sender_email,
        ]);
    }
}