<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Services\Delivery\DeliveryManager;
use App\Models\Package;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');


Route::middleware('client')->group(function(){
    Route::get('tracking', [PackageController::class, 'loadTracking'])
        ->name('load.tracking');
    Route::post('send-confirm', [PackageController::class, 'confirmSendForm'])
        ->name('packages.confirm');
});


Route::middleware('courier')->group(function(){
    Route::get('auto-collect', [DeliveryManager::class, 'processDelivery'])->name('auto.collect');
    Route::post('location-update', [DeliveryManager::class, 'setYourLocation'])->name('set.your.location');
    Route::get('start', [DeliveryController::class, 'create'])->name('deliveries.create');
   
});


Route::middleware(['auth'])->group(function(){
    Route::resource('packages', PackageController::class, ['only' => ['index', 'create', 'store', 'update', 'delete']]);
    Route::get('/packages/show/{package:package_number}', [PackageController::class, 'show'])->name('packages.show');
});


require __DIR__.'/auth.php';
