<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bucket;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BucketController extends Controller
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
        $title = "create bucket";
        $module = "bucket";
        return view('admin.buckets.add', compact('title', 'module'));
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
                'name' => 'required|max:50',
            ]
        );

        // Insert bucket data
        $bucket = new Bucket;
        $bucket->name = $request->input('name');
        $bucket->user_id = Auth::user()->id;
        $bucket->save();

        $str = "BKT";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $bucket->id;

        $bucket->unique_id = $uid;
        $bucket->save();

        return redirect()->route('admin.bucket.create')->with('success', 'Bucket added successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "buckets lists";
        $module = "bucket";
        $data = Bucket::active()->latest()->get();
        return view('admin.bucket.create', compact('data', 'title', 'module'));
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Bucket::query())->make(true);
        $bucketsdata = Bucket::select('buckets.id', 'buckets.name', 'buckets.status', 'buckets.created_at', 'buckets.updated_at')->orderBy("name", "asc");

        return Datatables::of($bucketsdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buckets.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buckets.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($bucketsdata) {
                return $name = ucwords($bucketsdata->name);
            })
            ->addColumn('created_at', function ($bucketsdata) {
                return $status = date("F j, Y, g:i a", strtotime($bucketsdata->created_at));
            })
            ->addColumn('status', function ($bucketsdata) {
                return $status = ($bucketsdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($bucketsdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('bucket.delete', $bucketsdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the record?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.bucket.enable', $bucketsdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.bucket.disable', $bucketsdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($bucketsdata->status == 1) ? $link . $inactivelink : $link . $activelink;
                // $link = '<a href="' . route('service.delete', $bucketsdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Enable the specified bucket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Bucket $bucket, $id)
    {
        $bucket = Bucket::findOrFail($id);
        $bucket->status = "1";
        $bucket->save();
        return redirect()->route('admin.bucket.create')->with('success', 'Bucket enabled.');
    }

    /**
     * Disable the specified bucket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Bucket $bucket, $id)
    {
        $bucket = Bucket::findOrFail($id);
        $bucket->status = "0";
        $bucket->save();
        return redirect()->route('admin.bucket.create')->with('warning', 'Bucket disabled.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function show(Bucket $bucket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function edit(Bucket $bucket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bucket $bucket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bucket $bucket, $id)
    {
        $bucket = Bucket::findOrFail($id);
        $bucket->delete();

        // Shows the remaining list of buckets.
        return redirect()->route('admin.bucket.create')->with('error', 'bucket removed permanently.');
    }
}
