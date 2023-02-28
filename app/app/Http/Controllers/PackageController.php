<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Address\StoreAddressDTO;
use App\DataTransferObjects\Package\StorePackageDTO;
use App\Events\PackageCreated;
use App\Http\Requests\PrevalidateStoreRequest;
use App\Http\Requests\StorePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Package\PackageService;
use App\Models\User;
use App\Services\Address\AddressService;

class PackageController extends Controller
{
    public function __construct(
        protected PackageService $packageService,
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
        }
        
        return redirect('/dashboard');     
    }

    public function confirmSendForm(PrevalidateStoreRequest $request)
    {
        return view('pages.send-confirm', ['request' => $request]);
    }

    public function store(StorePackageRequest $request)
    {
        $package_dto = new StorePackageDTO($request->validated());
        $package = $this->packageService->store($package_dto);

        $address_dto = new StoreAddressDTO($request->validated(), $package);
        $this->addressService->store(
            $address_dto,
            $package
        );

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

    public function loadTracking(Request $request)
    {
        $package = Package::where('package_number', '=', $request->package_number)->get();

        return view('pages.tracking', ['package' => $package]);
    }
}
