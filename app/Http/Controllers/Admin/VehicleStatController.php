<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\Brand;
use App\Models\BrandMedia;
use App\Models\VehicleStat;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\AjaxTrait;

class VehicleStatController extends Controller
{
    use AjaxTrait;

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
        $title = "add vehicle stats";
        $module = "vehicle";
        return view('admin.vehiclestats.add', compact('title', 'module', 'brands', 'vehicles'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request, $id)
    {
        $title = "vehicle stats lists";
        $module = "vehiclestat";
        // \DB::connection()->enableQueryLog();
        $vehicle = Vehicle::where(["status" => "1", "id" => $id])->with("stats", "features", "logoFile", "brand", "mainImage")->first();
        $queries = \DB::getQueryLog();
        // echo "<pre>";
        // return print_r($queries);
        // if (!$vehicle->stats) {
        //     abort("404");
        // }

        return view('admin.vehiclestats.stats', compact('title', 'module', 'vehicle'));
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
                'engine' => 'required|max:50',
                'power' => 'required|max:50',
                'zero_to_hundred' => 'required|max:50',
                'top_speed' => 'required|max:50',
                'weight' => 'required|max:50',
            ]
        );

        // Insert VehicleStat data
        $vehicleStat = new VehicleStat;
        $vehicleStat->brand_id = $request->input('brand');
        $vehicleStat->vehicle_id = $request->input('vehicle');
        $vehicleStat->engine = $request->input('engine');
        $vehicleStat->power = $request->input('power');
        $vehicleStat->zero_to_hundred = $request->input('zero_to_hundred');
        $vehicleStat->top_speed = $request->input('top_speed');
        $vehicleStat->weight = $request->input('weight');
        $vehicleStat->user_id = Auth::user()->id;
        $vehicleStat->save();

        $str = "VHCLSTAT";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehicleStat->id;

        $vehicleStat->unique_id = $uid;
        $vehicleStat->save();

        return redirect()->route('admin.vehicle.list')->with('success', 'Vehicle stats added successfully.');
    }
}
