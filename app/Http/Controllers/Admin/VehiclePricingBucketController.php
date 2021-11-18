<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\Bucket;
use App\Models\VehiclePricingBucket;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VehiclePricingBucketController extends Controller
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
        $buckets = Bucket::active()->orderBy("name", "asc")->get();
        $vehicles = Vehicle::active()->orderBy("name", "asc")->limit(10)->get();
        $title = "attach bucket";
        $module = "vehicle";
        return view('admin.vehiclepricingbuckets.add', compact('title', 'module', 'brands', 'vehicles', 'buckets'));
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
                'bucket' => 'required|max:50',
                'rate' => 'required|max:50',
            ]
        );

        // Insert VehiclePricingBucket data
        $vehiclePricingBucket = new VehiclePricingBucket;
        $vehiclePricingBucket->brand_id = $request->input('brand');
        $vehiclePricingBucket->vehicle_id = $request->input('vehicle');
        $vehiclePricingBucket->bucket_id = $request->input('bucket');
        $vehiclePricingBucket->rate = $request->input('rate');
        $vehiclePricingBucket->user_id = Auth::user()->id;
        $vehiclePricingBucket->save();

        $str = "VPB";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehiclePricingBucket->id;

        $vehiclePricingBucket->unique_id = $uid;
        $vehiclePricingBucket->save();

        return redirect()->route('admin.vehiclepricingbucket.create')->with('success', 'Bucket attached successfully.');
    }


    public function getavailablebuckets()
    {
        if ($_POST['vehicle_id'] == 0) {
            return view('admin.ajax.nobuckets');
        } else {
            $buckets = Bucket::where(["status" => "1"])->pluck("name", "id");
            $vehiclesBucket = VehiclePricingBucket::where(["status" => "1", "vehicle_id" => $_POST['vehicle_id']])->count();
            if ($vehiclesBucket > 0) {
                $vehiclesBucketIds = VehiclePricingBucket::where(["status" => "1", "vehicle_id" => $_POST['vehicle_id']])->pluck("bucket_id");
                $availablebuckets = Bucket::where(["status" => "1"])->whereNotIn("id", $vehiclesBucketIds)->pluck("name", "id");
                if (count($availablebuckets) > 0) {
                    return view('admin.ajax.vehiclebuckets', compact('availablebuckets'));
                } else {
                    return view('admin.ajax.nobuckets');
                }
            } else {
                return view('admin.ajax.defaultvehiclebuckets', compact('buckets'));
            }
        }
    }
}
