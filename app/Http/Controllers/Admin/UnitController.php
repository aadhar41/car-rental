<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class UnitController extends Controller
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
        $title = "add unit";
        $module = "unit";
        return view('admin.units.add', compact('title', 'module'));
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
                'name' => 'required|max:80|unique:units',
                'symbol' => 'required|max:150',
            ]
        );

        // Insert unit data
        $unit = new Unit;
        $unit->name = $request->input('name');
        $unit->symbol = $request->input('symbol');
        $unit->user_id = Auth::user()->id;
        $unit->save();

        $str = "UNT";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $unit->id;

        $unit->unique_id = $uid;
        $unit->save();

        return redirect()->route('admin.unit.list')->with('success', 'Unit added successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "unit lists";
        $module = "unit";
        $data = Unit::active()->orderBy('created_at', 'desc')->get();
        return view('admin.units.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Unit::query())->make(true);
        $unitsdata = Unit::select('units.id', 'units.name', 'units.symbol', 'units.status', 'units.created_at', 'units.updated_at');

        // $unitsdata = Unit::select('units.id', 'units.name', 'units.logo', 'units.image', 'units.status', 'units.created_at', 'units.updated_at');
        return Datatables::of($unitsdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('units.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('units.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($unitsdata) {
                return $name = ucwords($unitsdata->name);
            })
            ->addColumn('created_at', function ($unitsdata) {
                return $status = date("F j, Y, g:i a", strtotime($unitsdata->created_at));
            })
            ->addColumn('status', function ($unitsdata) {
                return $status = ($unitsdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($unitsdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('unit.delete', $unitsdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the unit?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.unit.enable', $unitsdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.unit.disable', $unitsdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($unitsdata->status == 1) ? $link . $inactivelink : $link . $activelink;
                // $link = '<a href="' . route('unit.delete', $unitsdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Enable the specified Unit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Unit $unit, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->status = "1";
        $unit->save();
        return redirect()->route('admin.unit.list')->with('success', 'Unit enabled.');
    }

    /**
     * Disable the specified unit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Unit $unit, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->status = "0";
        $unit->save();
        return redirect()->route('admin.unit.list')->with('warning', 'Unit disabled.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit, $id)
    {
        // Fetch that unit.
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('admin.unit.list')->with('warning', 'Unit removed.');
    }
}
