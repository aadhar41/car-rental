<?php

namespace App\Http\Controllers\Front;

use App\Models\Front;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::active()->with("mainImage", "logoFile")->orderBy("order", "ASC")->get();
        $data = Front::orderBy('created_at', 'desc')->first();
        return view('front.home', compact('data', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function edit(Front $front)
    {
        $count = Front::orderBy('created_at', 'desc')->count();
        if ($count > 0) {
            $listings = Front::orderBy('created_at', 'desc')->first();
            $title = "front";
            $module = "Front";
            return view('admin.front.front', compact('listings', 'title', 'module'));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Front $front, $id)
    {
        $this->validate($request, [
            'herosection' => 'required',
            'aboutcontent_text' => 'required',
            'iconicdreams_h2' => 'required',
            'iconicdreams_h6' => 'required',
            'iconicdreams_p' => 'required',
        ]);

        $file1 = $request->file('about_image');
        $file2 = $request->file('iconicdreams_image');

        // if ($request->file('about_image')) {
        //     $name1 = 'about_' . time() . '.' . $file1->getClientOriginalExtension();
        //     $request->about_image->storeAs('about', $name1);
        // }

        // if ($request->file('iconicdreams_image')) {
        //     $name2 = 'iconicdreams_' . time() . '.' . $file2->getClientOriginalExtension();
        //     $request->iconicdreams_image->storeAs('iconicdreams', $name2);
        // }

        if ($request->file('about_image')) {
            $name1 = 'about_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/about');
            $file1->move($destinationPath1, $name1);
        }

        if ($request->file('iconicdreams_image')) {
            $name2 = 'iconicdreams_' . time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/iconicdreams');
            $file2->move($destinationPath2, $name2);
        }

        // Update data
        $front = Front::find($id);
        $front->herosection = $request->input("herosection");
        $front->aboutcontent_text = $request->input('aboutcontent_text');
        $front->iconicdreams_h2 = $request->input('iconicdreams_h2');
        $front->iconicdreams_h6 = $request->input('iconicdreams_h6');
        $front->iconicdreams_p = $request->input('iconicdreams_p');
        $front->aboutcontent_image = (isset($name1)) ? $name1 : $front->aboutcontent_image;
        $front->iconicdreams_image = (isset($name2)) ? $name2 : $front->iconicdreams_image;
        $front->save();

        return redirect()->route('admin.front.edit')->with('success', 'Details Updated.');
    }
}
