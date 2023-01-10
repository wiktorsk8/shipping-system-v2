<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrevalidateStoreRequest;
use App\Http\Requests\StorePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PackageService;
use App\Helpers\Requests\RequestHelper;


class PackageController extends Controller
{
    // --------------------------------------------------------------------------
    // <CRUD>

    public function index() // choose a package to deliver for couriers
    {
        return redirect()->route('dashboard');
    }

    public function store(StorePackageRequest $request)
    {
        $collected = collect($request->all());
        $coordinates = PackageService::process_request($collected);
        $validated = array_merge($request->all(), $coordinates);

        Package::create($validated);

        return redirect()->route('dashboard');
    }


    public function show(Package $package)
    {
        if (Auth::user()->isCourier()) {
            return view('pages.package-info', ['package' => $package]);
        }

        return redirect('/dashboard');
    }


    public function update(Request $request, Package $package) // IN PROGRESS
    {
        if (!Auth::user()->isAdmin()) { // idk why error is highlighted but it's working
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
