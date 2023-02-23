<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrevalidateStoreRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Services\GoogleApiService;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PackageService;
use App\Services\Package\PackageService as Service;
use App\Models\Address;
use App\Models\User;
use App\Services\Address\AddressService;

class PackageController extends Controller
{

    public function __construct(
        protected Service $packageService,
        protected AddressService $addressService,
    )
    {}

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
        $package = $this->packageService->store($request);

        $this->addressService->store($request, $package);

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
