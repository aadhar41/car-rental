<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $profile)
    {
        $title = "profile";
        $module = "profile";
        $id = auth()->user()->id;
        $user = User::where("id", $id)->with("profile")->first();
        return view('admin.userprofile.edit', compact('title', 'module', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userprofile, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png',
            'location' => 'required|max:100',
            'education' => 'required|max:150',
            'title' => 'required|max:500',
            'skills' => 'required|max:500',
            'notes' => 'max:550',
        ]);

        $file1 = $request->file('image');

        if ($request->file('image')) {
            $name1 = 'user_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/users');
            $file1->move($destinationPath1, $name1);
        }

        // Update data
        $user = User::find($id);
        $user->name = $request->input("name");
        $user->save();

        $count = UserProfile::where("user_id", $id)->count();

        if ($count > 0) {
            $profile = UserProfile::where("user_id", $id)->first();
            $profile->title = $request->input("title");
            $profile->education = $request->input("education");
            $profile->location = $request->input("location");
            $profile->skills = $request->input("skills");
            $profile->note = $request->input("note");
            $profile->image = (isset($name1)) ? $name1 : $profile->image;
            $profile->save();
        } else {
            $profile = new UserProfile;
            $profile->title = $request->input("title");
            $profile->education = $request->input("education");
            $profile->location = $request->input("location");
            $profile->skills = $request->input("skills");
            $profile->note = $request->input("note");
            $profile->image = (isset($name1)) ? $name1 : $profile->image;
            $profile->user_id = Auth::user()->id;
            $profile->save();

            $str = "USPRFLE";
            $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $profile->id;

            $profile->unique_id = $uid;
            $profile->save();
        }

        return redirect()->route('admin.userprofile.edit')->with('success', 'Profile Updated.');
    }
}
