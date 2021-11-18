<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\Brand;
use App\Models\BrandMedia;
use App\Models\VehicleStat;
use App\Models\VehicleFeature;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VehicleFeatureController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $title = "add vehicle features";
        $module = "vehicle";
        return view('admin.vehiclefeatures.add', compact('title', 'module', 'brands', 'vehicles'));
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
                'brand' => 'required',
                'vehicle' => 'required',
                'colour' => 'required|max:50',
                'colour_code' => 'required|max:50',
                'persons' => 'required|max:50',
                'gear_box' => 'required|max:50',
            ]
        );

        // Insert VehicleFeature data
        $vehicleFeature = new VehicleFeature;
        $vehicleFeature->brand_id = $request->input('brand');
        $vehicleFeature->vehicle_id = $request->input('vehicle');
        $vehicleFeature->colour = $request->input('colour');
        $vehicleFeature->colour_code = $request->input('colour_code');
        $vehicleFeature->persons = $request->input('persons');
        $vehicleFeature->gear_box = $request->input('gear_box');
        $vehicleFeature->user_id = Auth::user()->id;
        $vehicleFeature->save();

        $str = "VHCLFTRE";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehicleFeature->id;

        $vehicleFeature->unique_id = $uid;
        $vehicleFeature->save();

        return redirect()->route('admin.vehicle.list')->with('success', 'Vehicle features added successfully.');
    }
}
