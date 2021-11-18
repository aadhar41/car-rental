<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehicleStat;
use App\Models\VehicleFeature;
use App\Models\Brand;
use App\Models\BrandMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VehicleController extends Controller
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
        $title = "add vehicle";
        $module = "vehicle";
        return view('admin.vehicles.add', compact('title', 'brands', 'module'));
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
                'name' => 'required|max:80|unique:vehicles',
                'slogan' => 'required|max:150',
                'vehicle_brand' => 'required',
                'description' => 'required|max:150',
                'vehicle_logo' => 'required|mimes:jpeg,jpg,png',
                'vehicle_image' => 'required|mimes:jpeg,jpg,png',
            ]
        );


        // Insert vehicle data
        $vehicle = new Vehicle;
        $vehicle->name = $request->input('name');
        $vehicle->slug = $this->generateSlug($request->input('name'));
        $vehicle->brand_id = $request->input("vehicle_brand");
        $vehicle->slogan = $request->input("slogan");
        $vehicle->description = $request->input("description");
        $vehicle->user_id = Auth::user()->id;
        $vehicle->save();

        $str = "VECLE";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehicle->id;

        $vehicle->unique_id = $uid;
        $vehicle->save();

        // Upload files.
        $file1 = $request->file('vehicle_logo');
        $file2 = $request->file('vehicle_image');
        $name = $this->sanitizeString($request->input('name'));
        $vehicleId = $vehicle->id;

        if ($request->file('vehicle_logo')) {
            $name1 = $vehicleId . '_' . $uid . '_logo_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/vehicles/logos');
            $file1->move($destinationPath1, $name1);
        }

        if ($request->file('vehicle_image')) {
            $name2 = $vehicleId . '_' . $uid . '_image_' . time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/vehicles/images');
            $file2->move($destinationPath2, $name2);
        }


        // Insert logo into vehicle media.
        $vehiclemedia = new VehicleMedia;
        $vehiclemedia->file = (isset($name1)) ? $name1 : "default.png";
        $vehiclemedia->type = "2";
        $vehiclemedia->user_id = Auth::user()->id;
        $vehiclemedia->vehicle_id = $vehicle->id;
        $vehiclemedia->save();

        $str = "VCLMD";
        $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehiclemedia->id;

        $vehiclemedia->unique_id = $ubid;
        $vehiclemedia->save();



        // Insert Image into vehicle media.
        $vehiclemedia = new VehicleMedia;
        $vehiclemedia->file = (isset($name2)) ? $name2 : "default.png";
        $vehiclemedia->type = "6";
        $vehiclemedia->user_id = Auth::user()->id;
        $vehiclemedia->vehicle_id = $vehicle->id;
        $vehiclemedia->save();

        $str = "VCLMD";
        $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $vehiclemedia->id;

        $vehiclemedia->unique_id = $ubid;
        $vehiclemedia->save();

        return redirect()->route('admin.vehicle.list')->with('success', 'Vehicle added successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "vehicle lists";
        $module = "vehicle";
        $brands = Brand::active()->orderBy("name", "asc")->get();
        $data = Vehicle::active()->orderBy('created_at', 'desc')->get();
        return view('admin.vehicles.index', compact('data', 'title', 'module', 'brands'));
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Brand::query())->make(true);
        $vehiclesdata = Vehicle::select('vehicles.id', 'vehicles.name', 'vehicles.slogan', 'vehicles.status', 'vehicles.created_at', 'vehicles.updated_at')->with('media');

        // $vehiclesdata = Brand::select('vehicles.id', 'vehicles.name', 'vehicles.logo', 'vehicles.image', 'vehicles.status', 'vehicles.created_at', 'vehicles.updated_at');
        return Datatables::of($vehiclesdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('vehicles.status', 'like', "%{$request->get('status')}%");
                    });
                }
                if ($request->has('brand') && $request->get('brand') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('vehicles.brand_id', 'like', $request->get('brand'));
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('vehicles.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($vehiclesdata) {
                return $name = ucwords($vehiclesdata->name);
            })
            ->addColumn('logo', function ($vehiclesdata) {
                return $logo = ($vehiclesdata->logoFile->file);
            })
            ->addColumn('image', function ($vehiclesdata) {
                return $image = ($vehiclesdata->mainImage->file);
            })
            ->addColumn('created_at', function ($vehiclesdata) {
                return $status = date("F j, Y, g:i a", strtotime($vehiclesdata->created_at));
            })
            ->addColumn('status', function ($vehiclesdata) {
                return $status = ($vehiclesdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($vehiclesdata) {

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.vehicle.edit', $vehiclesdata->id) . '" class="btn btn-sm btn-default bg-maroon mt-1 mb-1" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $link = '
                    <div class="btn-group">
                        <a href="' . route('vehicle.delete', $vehiclesdata->id) . '" class="btn btn-sm btn-danger  mt-1 mb-1" title="Delete" onclick="return confirm(\'Do you really want to delete the vehicle?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $statslink = '
                    <div class="btn-group">
                        <a href="' . route('admin.vehicle.show', $vehiclesdata->id) . '" class="btn btn-sm btn-info mt-1 mb-1" title="View Details" ><i class="fas fa-eye"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.vehicle.enable', $vehiclesdata->id) . '" class="btn btn-sm btn-warning mt-1 mb-1" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.vehicle.disable', $vehiclesdata->id) . '" class="btn btn-sm btn-success mt-1 mb-1" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($vehiclesdata->status == 1) ? $editlink . $link . $inactivelink . $statslink : $editlink .  $link . $activelink . $statslink;
                // $link = '<a href="' . route('service.delete', $vehiclesdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle, $id)
    {
        $title = "Vehicle Details";
        $module = "vehicle";
        // \DB::connection()->enableQueryLog();
        $vehicle = Vehicle::where(["status" => "1", "id" => $id])->with("stats", "features", "logoFile", "brand", "mainImage", "package1", "package2", "package3", "buckets", "bucket1", "bucket2", "bucket3", "bucket4")->first();
        $queries = \DB::getQueryLog();
        // echo "<pre>";
        // return print_r($queries);
        // if (!$vehicle->stats) {
        //     abort("404");
        // }

        return view('admin.vehicles.show', compact('title', 'module', 'vehicle'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle, $id)
    {
        $title = "vehicle details edit";
        $module = "vehicle";
        $brands = Brand::active()->with("mainImage", "logoFile")->orderBy("name", "asc")->get();
        $vehicle = Vehicle::where("id", $id)->with("stats", "features", "logoFile", "brand", "mainImage", "package1", "package2", "package3", "buckets", "bucket1", "bucket2", "bucket3", "bucket4")->first();
        $vehiclestat = VehicleStat::where("vehicle_id", $id)->with("branddetails", "vehicledetails", "userdetails")->first();
        $vehiclefeature = VehicleFeature::where("vehicle_id", $id)->with("branddetails", "vehicledetails", "userdetails")->first();
        return view('admin.vehicles.edit', compact('title', 'module', 'vehicle', 'vehiclestat', 'brands', 'vehiclefeature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        // die;
        $this->validate(
            $request,
            [
                'name' => 'required|max:80|unique:vehicles,id,' . $id,
                'slogan' => 'required|max:150',
                'vehicle_brand' => 'required',
                'description' => 'required|max:150',
                'vehicle_logo' => 'mimes:jpeg,jpg,png',
                'vehicle_image' => 'mimes:jpeg,jpg,png',
            ]
        );

        // Insert vehicle data
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->name = $request->input('name');
        $vehicle->slug = $this->generateSlug($request->input('name'));
        $vehicle->brand_id = $request->input("vehicle_brand");
        $vehicle->slogan = $request->input("slogan");
        $vehicle->description = $request->input("description");
        $vehicle->user_id = Auth::user()->id;
        $vehicle->save();

        // Upload files.
        $file1 = $request->file('vehicle_logo');
        $file2 = $request->file('vehicle_image');
        $imgname = $this->sanitizeString($request->input('name'));
        $name = $request->input('name');
        $vehicleId = $vehicle->id;

        if ($request->file('vehicle_logo')) {
            $name1 = $vehicleId . '_' . '_logo_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/vehicles/logos');
            $file1->move($destinationPath1, $name1);
        }

        if ($request->file('vehicle_image')) {
            $name2 = $vehicleId . '_'  . '_image_' . time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/vehicles/images');
            $file2->move($destinationPath2, $name2);
        }


        // Update logo into Vehicle media.
        $vehiclemedia1 = VehicleMedia::where(["status" => "1", "vehicle_id" => $id, "type" => "2"])->first();
        $vehiclemedia1->file = (isset($name1)) ? $name1 : $vehiclemedia1->file;
        $vehiclemedia1->user_id = Auth::user()->id;
        $vehiclemedia1->save();

        // Update Image into Vehicle media.
        $vehiclemedia2 = VehicleMedia::where(["status" => "1", "vehicle_id" => $id, "type" => "6"])->first();
        $vehiclemedia2->file = (isset($name2)) ? $name2 : $vehiclemedia2->file;
        $vehiclemedia2->user_id = Auth::user()->id;
        $vehiclemedia2->save();

        // Vehicle stats Update
        $vehiclestat = VehicleStat::findOrFail($id);
        $vehiclestat->engine = $request->input('engine');
        $vehiclestat->power = $request->input('power');
        $vehiclestat->zero_to_hundred = $request->input('zero_to_hundred');
        $vehiclestat->top_speed = $request->input('top_speed');
        $vehiclestat->weight = $request->input('weight');
        $vehiclestat->user_id = Auth::user()->id;
        $vehiclestat->save();

        // Vehicle Features Update
        $vehiclefeatures = VehicleFeature::findOrFail($id);
        $vehiclefeatures->colour = $request->input('colour');
        $vehiclefeatures->colour_code = $request->input('colour_code');
        $vehiclefeatures->persons = $request->input('persons');
        $vehiclefeatures->gear_box = $request->input('gear_box');
        $vehiclefeatures->user_id = Auth::user()->id;
        $vehiclefeatures->save();

        return redirect()->route('admin.vehicle.list')->with('success', 'Vehicle details updated successfully.');
    }


    /**
     * Enable the specified Vehicle in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Vehicle $vehicle, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = "1";
        $vehicle->save();
        return redirect()->route('admin.vehicle.list')->with('success', 'Vehicle service enabled.');
    }

    /**
     * Disable the specified vehicle in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Vehicle $vehicle, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = "0";
        $vehicle->save();
        return redirect()->route('admin.vehicle.list')->with('warning', 'Vehicle service disabled.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle, $id)
    {
        // Fetch that vehicle.
        $vehicle = Vehicle::findOrFail($id);


        $vehiclemedia = VehicleMedia::where(["vehicle_id" => $id])->get();
        foreach ($vehiclemedia as $media) {
            // Remove Image after deleting that vehicle.
            $path1 = public_path() . "/images/vehicles/images/" . $media->file;
            // unlink($path1);
            File::delete($path1);

            $path2 = public_path() . "/images/vehicles/logos/" . $media->file;
            // unlink($path2);
            File::delete($path2);
        }

        $vehicle->delete();
        $vehiclemedia1 = VehicleMedia::where(["vehicle_id" => $id]);
        $vehiclemedia1->delete();

        // Shows the remaining list of vehicles.
        return redirect()->route('admin.vehicle.list')->with('error', 'vehicle removed permanently.');
    }
}
