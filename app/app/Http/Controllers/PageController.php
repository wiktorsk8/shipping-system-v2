<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            if (Auth::user()->isClient()) {
                return view('pages.client-dashboard');
            } elseif (Auth::user()->isCourier()) {
                $packages = Package::where('status', '0')->get();
                return view('pages.courier-dashboard', ['packages' => $packages]);
            }
        }
        

        return view('auth.login');
    }
}
