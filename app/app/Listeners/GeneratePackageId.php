<?php

namespace App\Listeners;

use App\Events\PackageCreated;
use App\Models\Package;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class GeneratePackageId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PackageCreated $event)
    {
        $event->package->package_number = Package::generate(Auth::user()->id, $event->package->name);
    }
}
