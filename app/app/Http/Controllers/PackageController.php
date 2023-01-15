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

class PackageController extends Controller
{
    // --------------------------------------------------------------------------
    // <CRUD>

    public function index() // choose a package to deliver for couriers
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isClient()) {
            return view('pages.send');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    public function confirmSendForm(PrevalidateStoreRequest $request){
        return view('pages.send-confirm', collect($request->all()));
    }

    public function store(StorePackageRequest $request)
    {
        $collected = collect($request->all());

        $sender = [
            'street' => $collected->street,
            'street_number' => $collected->street_number,
            'flat_number' => $collected->flat_number,
            'postal_code' => $collected->postal_code,
            'city' => $collected->city,
            'coordinates' => GoogleApiService::addressToCoordinates($collected->senders_full_address)
        ];

        $recipient = [
            'street' => $collected->recipients_street,
            'street_number' => $collected->recipients_street_number,
            'flat_number' => $collected->recipients_flat_number,
            'postal_code' => $collected->recipients_postal_code,
            'city' => $collected->recipients_city,
            'coordinates' => GoogleApiService::addressToCoordinates($collected->recipients_full_address)
        ];

        $senders_address = Address::create($sender);
        $recipients_address = Address::create($recipient);

        Package::create([
            'package_number' => $collected->package_number,
            'name' => $collected->name,
            'status' => $collected->status,
            'recipients_email' => $collected->recipients_email,
            'senders_email' => $collected->senders_email,
            'senders_address' => $senders_address->id,
            'recipients_address' => $recipients_address->id
        ]);

        return redirect()->route('dashboard');
    }


    public function show(Package $package)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isCourier()) {
            return view('pages.package-info', ['package' => $package]);
        }

        return redirect('/dashboard');
    }


    public function update(Request $request, Package $package) // IN PROGRESS
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isAdmin()) { // idk why error is highlighted but it's working
            return redirect('/dashboard');
        }

        $package->update($request->all());

        return redirect('/dashboard');
    }


    public function destroy(Package $package)
    {
        //only with admin permissions
        $package->delete();

        return redirect('/');
    }

    // </CRUD>
    // --------------------------------------------------------------------------

    //  other services
    //

    public function updateStatus(Package $package) // method only for couriers
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
