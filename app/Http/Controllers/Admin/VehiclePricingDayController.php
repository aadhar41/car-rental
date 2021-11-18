<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehiclePricingDay;
use App\Models\Brand;
use App\Models\BrandMedia;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VehiclePricingDayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::active()->orderBy("name", "asc")->get();
        $vehicles = Vehicle::active()->orderBy("name", "asc")->limit(10)->get();
        $title = "add vehicle pricing";
        $module = "vehicle";
        return view('admin.vehiclepricingdays.add', compact('title', 'module', 'brands', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'vehicle' => 'required',
                'days' => 'required|max:50',
                'rate' => 'required|max:50',
            ]
        );

        // Insert VehiclePricingDay data
        $vehiclePricingDay = new VehiclePricingDay;
        $vehiclePricingDay->brand_id = $request->input('brand');
        $vehiclePricingDay->vehicle_id = $request->input('vehicle');
        $vehiclePricingDay->days = $request->input('days');
        $vehiclePricingDay->rate = $request->input('rate');
        $vehiclePricingDay->user_id = Auth::user()->id;
        $vehiclePricingDay->save();

        $str = "VPD";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehiclePricingDay->id;

        $vehiclePricingDay->unique_id = $uid;
        $vehiclePricingDay->save();

        return redirect()->route('admin.vehiclepricing.create')->with('success', 'Vehicle pricing added successfully.');
    }
}
