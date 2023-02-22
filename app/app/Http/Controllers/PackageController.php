<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrevalidateStoreRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Services\GoogleApiService;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PackageService;
use App\Models\Address;
use App\Models\User;

class PackageController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isClient()) {
            return view('pages.send');
        } else {
            return redirect('/dashboard');
        }
    }

    public function confirmSendForm(PrevalidateStoreRequest $request)
    {
        return view('pages.send-confirm', ['request' => $request]);
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create([
            'package_number' => $request->package_number,
            'name' => $request->name,
            'status' => $request->status,
            'size' => $request->size,
            'recipients_email' => $request->recipients_email,
            'senders_email' => $request->senders_email,
        ]);

        Address::create([
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

        return redirect()->route('dashboard');
    }

    public function show(Package $package)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isClient()) {
            return redirect('/dashboard');
        }

        return view('pages.package-info', ['package' => $package]);
    }

    public function update(Request $request, Package $package)
    {
        // in progress
        redirect('/dashboard');
    }

    public function destroy(Package $package)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->Client()) {
            return view('pages.dashboard');
        }
        
        $package->delete();

        return redirect('/');
    }

    public function updateStatus(Package $package)
    {
        PackageService::pushStatus($package);

        return redirect('dashboard');
    }

    public function loadTracking(Request $request)
    {
        $package = Package::where('package_number', '=', $request->package_number)->get();

        return view('pages.tracking', ['package' => $package]);
    }
}
