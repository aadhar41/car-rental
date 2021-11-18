<?php

namespace App\Http\Controllers\Front;

use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\Brand;
use App\Models\BrandMedia;
use App\Models\VehicleDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $count = Vehicle::where([
            ['slug', '=', $slug],
            ['status', '=', '1'],
        ])->with("logoFile", "mainImage")->count();

        if ($count == 0) {
            abort("404");
        }

        $vehicle = Vehicle::where([
            ['slug', '=', $slug],
            ['status', '=', '1'],
        ])->with("logoFile", "mainImage", "stats", "features", "package1", "package2", "package3", "bucket1", "bucket2", "bucket3", "bucket4")->first();

        $similarVehicles = Vehicle::where([
            ['brand_id', '=', $vehicle->brand_id],
            ['id', '!=', $vehicle->id],
            ['status', '=', '1'],
        ])->pluck("id");

        $ids = [];
        foreach ($similarVehicles as $key => $value) {
            array_push($ids, $value);
        }

        $count = count($ids) - 1;
        $next = $ids[rand(0, $count)];
        // $next = $ids[0];

        $similarVehicle = Vehicle::where([
            ['brand_id', '=', $vehicle->brand_id],
            ['id', '=', $next],
            ['status', '=', '1'],
        ])->with("mainImage")->first();

        return view('front.vehicle', compact('vehicle', 'similarVehicle'));
    }
}
