<?php

namespace App\Services\Package;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageService
{
    public function store(Request $request){
        return Package::create([
            'package_number' => $request->package_number,
            'name' => $request->name,
            'status' => $request->status,
            'size' => $request->size,
            'recipients_email' => $request->recipients_email,
            'senders_email' => $request->senders_email,
        ]);
    }
}