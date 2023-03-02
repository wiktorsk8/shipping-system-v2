<?php

namespace App\Services\Package;

use App\DataTransferObjects\Package\StorePackageDTO;
use App\Events\PackageCreated;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageService
{
    public function store(StorePackageDTO $data): Package{
        
        $package = new Package();
        $package->name = $data->name;
        $package->status = $data->status;
        $package->size = $data->size;
        $package->recipient_email = $data->recipient_email;
        $package->sender_email =  $data->sender_email;

        PackageCreated::dispatch($package);
        
        $package->save();

        return $package;
    }
}