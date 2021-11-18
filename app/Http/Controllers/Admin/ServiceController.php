<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicesCount = Service::active()->count();

        $data = Service::active()->orderBy('name', 'asc')->get();
        return view('front.services', compact('data', 'servicesCount'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "services lists";
        $module = "service";
        $data = Service::active()->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('data', 'title', 'module'));
    }



    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Service::query())->make(true);

        $servicedata = Service::select('services.id', 'services.name', 'services.image', 'services.status', 'services.created_at', 'services.updated_at');
        return Datatables::of($servicedata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('services.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('services.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($servicedata) {
                return $name = ucwords($servicedata->name);
            })
            ->addColumn('created_at', function ($servicedata) {
                return $status = date("F j, Y, g:i a", strtotime($servicedata->created_at));
            })
            ->addColumn('status', function ($servicedata) {
                return $status = ($servicedata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($servicedata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('service.delete', $servicedata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the service?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.service.enable', $servicedata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.service.disable', $servicedata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($servicedata->status == 1) ? $link . $inactivelink : $link . $activelink;
                // $link = '<a href="' . route('service.delete', $servicedata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "add service";
        $module = "service";
        return view('admin.services.add', compact('title', 'module'));
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
                'name' => 'required|max:30|unique:services',
                'service_image' => 'required|mimes:jpeg,jpg,png',
            ]
        );

        $file1 = $request->file('service_image');

        if ($request->file('service_image')) {
            $name1 = 'service_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/services');
            $file1->move($destinationPath1, $name1);
        }

        $service = new Service;
        $service->name = ($request->input('name'));
        $service->image = (isset($name1)) ? $name1 : "default.png";
        $service->user_id = Auth::user()->id;
        $service->save();

        $str = "SER";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $service->id;

        $service->unique_id = $uid;
        $service->save();

        return redirect()->route('admin.service.list')->with('success', 'Service added successfully.');
    }


    /**
     * Enable the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Service $service, $id)
    {
        $service = Service::findOrFail($id);
        $service->status = "1";
        $service->save();
        return redirect()->route('admin.service.list')->with('success', 'Service enabled.');
    }

    /**
     * Disable the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Service $service, $id)
    {
        $service = Service::findOrFail($id);
        $service->status = "0";
        $service->save();
        return redirect()->route('admin.service.list')->with('warning', 'Service disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, $id)
    {
        // $service = Service::where('id', $id)->withTrashed()->first();

        // // Fetch that service.
        $service = Service::findOrFail($id);
        $service->delete();
        // $filename = $service->image;

        // // Remove Image after deleting that service.
        // $path = public_path() . "/images/services/" . $filename;
        // File::delete($path);
        // $service->delete();

        // Shows the remaining list of services.
        return redirect()->route('admin.service.list')->with('error', 'Service deleted successfully.');
    }
}
