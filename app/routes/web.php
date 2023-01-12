<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Services\Delivery\DeliveryManager;
use App\Http\Services\GoogleApiService;

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
    Route::get('tracking', [PackageController::class, 'loadTracking'])->name('load.tracking');
    Route::get('/send', function(){
        return view('pages.send');
    })->name('send.package');
});



Route::middleware('courier')->group(function(){
    Route::get('fast-delivery', [DeliveryManager::class, 'callculateRoute'])->name('fast.delivery');
});



Route::middleware(['auth'])->group(function(){
    Route::resource('packages', PackageController::class);
});


require __DIR__.'/auth.php';
