<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "dashboard";
        $module = "dashboard";
        $totalUsers = User::all()->count();
        $totalBrands = Brand::active()->count();
        $totalServices = Service::active()->count();
        $totalVehicles = Vehicle::active()->count();
        $totalMemberships = Membership::active()->count();
        return view('admin.dashboard', compact('title', 'module', 'totalUsers', 'totalBrands', 'totalServices', 'totalVehicles', 'totalMemberships'));
    }
}
