<?php

namespace App\Http\Controllers\Admin;

use App\Models\Membership;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class MembershipController extends Controller
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
        $title = "add membership [ package ] discount";
        $module = "membership";
        return view('admin.membership.add', compact('title', 'module'));
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
                'days' => 'required|max:150',
                'rate' => 'required|max:250',
            ]
        );

        // Insert Membership Discount data
        $membership = new Membership;
        $membership->name = $request->input('name');
        $membership->days = $request->input('days');
        $membership->rate = $request->input('rate');
        $membership->user_id = Auth::user()->id;
        $membership->save();

        $str = "MBRDIS";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $membership->id;

        $membership->unique_id = $uid;
        $membership->save();

        return redirect()->route('admin.membership.list')->with('success', 'Record added successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "membership | packages lists";
        $module = "membership";
        $data = Membership::active()->orderBy('created_at', 'desc')->get();
        return view('admin.membership.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Membership::query())->make(true);
        $discountdata = Membership::select('memberships.id', 'memberships.name', 'memberships.days', 'memberships.rate', 'memberships.status', 'memberships.created_at', 'memberships.updated_at')->orderBy("name", "asc");

        return Datatables::of($discountdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('memberships.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('memberships.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($discountdata) {
                return $name = ucwords($discountdata->name);
            })
            ->addColumn('created_at', function ($discountdata) {
                return $status = date("F j, Y, g:i a", strtotime($discountdata->created_at));
            })
            ->addColumn('status', function ($discountdata) {
                return $status = ($discountdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($discountdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('membership.delete', $discountdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete this record?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.membership.enable', $discountdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.membership.disable', $discountdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($discountdata->status == 1) ? $link . $inactivelink : $link . $activelink;
                return $final;
            })
            ->make(true);
    }


    /**
     * Enable the specified Membership in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $Membership
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Membership $membership, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->status = "1";
        $membership->save();
        return redirect()->route('admin.membership.list')->with('success', 'Discount enabled.');
    }

    /**
     * Disable the specified Membership in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipDiscount  $membership
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Membership $membership, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->status = "0";
        $membership->save();
        return redirect()->route('admin.membership.list')->with('warning', 'Discount disabled.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        // Shows the remaining list of discounts.
        return redirect()->route('admin.membership.list')->with('error', 'Discount removed permanently.');
    }
}
