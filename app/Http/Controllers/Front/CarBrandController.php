<?php

namespace App\Http\Controllers\Front;

use App\Models\Front;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\Brand;
use App\Models\BrandMedia;
use App\Models\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $count = Brand::where([
            ['slug', '=', $slug],
            ['status', '=', '1'],
        ])->count();

        if ($count == 0) {
            abort("404");
        }

        $brand = Brand::active()->where([
            ['slug', '=', $slug],
        ])->with("logoFile", "associatedVehicles.mainImage")->first();

        return view('front.carbrand', compact('brand'));
    }
}
