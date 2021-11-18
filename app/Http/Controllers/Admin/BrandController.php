<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\BrandMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
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
        $title = "add brand";
        $module = "brand";
        return view('admin.brands.add', compact('title', 'module'));
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
                'name' => 'required|max:40|unique:brands',
                'heading' => 'required|max:150',
                'slogan' => 'required|max:250',
                'brand_logo' => 'required|mimes:jpeg,jpg,png',
                'brand_image' => 'required|mimes:jpeg,jpg,png',
            ]
        );

        $file1 = $request->file('brand_logo');
        $file2 = $request->file('brand_image');
        $name = $this->sanitizeString($request->input('name'));

        if ($request->file('brand_logo')) {
            $name1 = $name . '_logo_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/brands/logos');
            $file1->move($destinationPath1, $name1);
        }

        if ($request->file('brand_image')) {
            $name2 = $name . '_image_' . time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/brands/images');
            $file2->move($destinationPath2, $name2);
        }

        // Insert brand data
        $brand = new Brand;
        $brand->name = $name;
        $brand->slug = $this->generateSlug($name);
        $brand->heading = $request->input('heading');
        $brand->slogan = $request->input('slogan');
        $brand->user_id = Auth::user()->id;
        $brand->save();

        $str = "BRND";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $brand->id;

        $brand->order = $brand->id;
        $brand->unique_id = $uid;
        $brand->save();


        // Insert logo into brand media.
        $brandmedia = new BrandMedia;
        $brandmedia->file = (isset($name1)) ? $name1 : "default.png";
        $brandmedia->type = "2";
        $brandmedia->user_id = Auth::user()->id;
        $brandmedia->brand_id = $brand->id;
        $brandmedia->save();

        $str = "BRDMDA";
        $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $brandmedia->id;

        $brandmedia->unique_id = $ubid;
        $brandmedia->save();



        // Insert Image into brand media.
        $brandmedia = new BrandMedia;
        $brandmedia->file = (isset($name2)) ? $name2 : "default.png";
        $brandmedia->type = "6";
        $brandmedia->user_id = Auth::user()->id;
        $brandmedia->brand_id = $brand->id;
        $brandmedia->save();

        $str = "BRDMDA";
        $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $brandmedia->id;

        $brandmedia->unique_id = $ubid;
        $brandmedia->save();



        return redirect()->route('admin.brand.list')->with('success', 'Brand added successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        // echo "<pre>";
        // $brandsdata = Brand::select('brands.id', 'brands.name', 'brands.logo', 'brands.image', 'brands.status', 'brands.created_at', 'brands.updated_at')->with("logoFile", "mainImage")->first();
        // print_r($brandsdata->logoFile->file);
        // die;
        $title = "brands lists";
        $module = "brand";
        $data = Brand::active()->latest()->get();
        return view('admin.brands.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Brand::query())->make(true);
        $brandsdata = Brand::select('brands.id', 'brands.name', 'brands.heading', 'brands.slogan', 'brands.status', 'brands.order', 'brands.created_at', 'brands.updated_at')->orderBy("name", "asc")->with('media');

        // $brandsdata = Brand::select('brands.id', 'brands.name', 'brands.logo', 'brands.image', 'brands.status', 'brands.created_at', 'brands.updated_at');
        return Datatables::of($brandsdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('brands.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('brands.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($brandsdata) {
                return $name = isset($brandsdata->name) ? ucwords($brandsdata->name) : "";
            })
            ->addColumn('logo', function ($brandsdata) {
                return $logo = isset($brandsdata->logoFile->file) ? $brandsdata->logoFile->file : "";
            })
            ->addColumn('image', function ($brandsdata) {
                return $image = isset($brandsdata->mainImage->file) ? $brandsdata->mainImage->file : "";
            })
            ->addColumn('created_at', function ($brandsdata) {
                return $created = isset($brandsdata->created_at) ? date("F j, Y, g:i a", strtotime($brandsdata->created_at)) : "";
            })
            ->addColumn('status', function ($brandsdata) {
                return $status = ($brandsdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($brandsdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('brand.delete', $brandsdata->id) . '" class="btn btn-sm btn-danger mt-1 mb-1" title="Delete" onclick="return confirm(\'Do you really want to delete the brand?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.brand.edit', $brandsdata->id) . '" class="btn btn-sm btn-info mt-1 mb-1" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.brand.enable', $brandsdata->id) . '" class="btn btn-sm btn-warning mt-1 mb-1" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.brand.disable', $brandsdata->id) . '" class="btn btn-sm btn-success mt-1 mb-1" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($brandsdata->status == 1) ? $editlink . $link . $inactivelink : $editlink . $link . $activelink;
                // $link = '<a href="' . route('service.delete', $brandsdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand, $id)
    {
        $title = "brand";
        $module = "brand";
        $brand = Brand::where("id", $id)->with("mainImage", "logoFile")->first();
        return view('admin.brands.edit', compact('title', 'module', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand, $id)
    {


        $this->validate(
            $request,
            [
                'name' => 'required|max:40',
                'order' => 'required|max:20',
                'heading' => 'required|max:150',
                'slogan' => 'required|max:250',
                'brand_logo' => 'mimes:jpeg,jpg,png',
                'brand_image' => 'mimes:jpeg,jpg,png',
            ]
        );

        $file1 = $request->file('brand_logo');
        $file2 = $request->file('brand_image');
        $imgname = $this->sanitizeString($request->input('name'));
        $name = $request->input('name');

        if ($request->file('brand_logo')) {
            $name1 = $imgname . '_logo_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/brands/logos');
            $file1->move($destinationPath1, $name1);
        }

        if ($request->file('brand_image')) {
            $name2 = $imgname . '_image_' . time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/brands/images');
            $file2->move($destinationPath2, $name2);
        }


        $brandnew = Brand::active()->where(["id" => $id])->first();
        $brandoldcount = Brand::active()->where(["order" => $request->input('order')])->count();
        $brandold = Brand::active()->where(["order" => $request->input('order')])->first();

        if ($brandoldcount > 0) {
            $brandold->order = $brandnew->order;
            $brandold->save();
        }


        // Insert brand data
        $brand = Brand::findOrFail($id);
        $brand->name = $name;
        $brand->heading = $request->input('heading');
        $brand->slogan = $request->input('slogan');
        $brand->order = $request->input('order');
        $brand->user_id = Auth::user()->id;
        $brand->save();

        // Update logo into brand media.
        $brandmedia1 = BrandMedia::active()->where(["brand_id" => $id, "type" => "2"])->first();
        $brandmedia1->file = (isset($name1)) ? $name1 : $brandmedia1->file;
        $brandmedia1->user_id = Auth::user()->id;
        $brandmedia1->save();

        // Update Image into brand media.
        $brandmedia2 = BrandMedia::active()->where(["brand_id" => $id, "type" => "6"])->first();
        $brandmedia2->file = (isset($name2)) ? $name2 : $brandmedia2->file;
        $brandmedia2->user_id = Auth::user()->id;
        $brandmedia2->save();

        return redirect()->route('admin.brand.list')->with('success', 'Brand updated successfully.');
    }


    /**
     * Enable the specified brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Brand $brand, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = "1";
        $brand->save();
        return redirect()->route('admin.brand.list')->with('success', 'Brand enabled.');
    }

    /**
     * Disable the specified brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Brand $brand, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = "0";
        $brand->save();
        return redirect()->route('admin.brand.list')->with('warning', 'Brand disabled.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, $id)
    {
        // Fetch that brand.
        $brand = Brand::findOrFail($id);
        $filename = $brand->logo;
        $brand->delete();

        // Remove Image after deleting that brand.
        $path = public_path() . "/images/brands/" . $filename;
        File::delete($path);

        // Shows the remaining list of brands.
        return redirect()->route('admin.brand.list')->with('error', 'brand removed permanently.');
    }
}
