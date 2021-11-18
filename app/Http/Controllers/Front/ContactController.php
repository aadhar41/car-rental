<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.home');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:contacts|max:100',
            'message' => 'max:500',
            'confirm' =>
            Rule::in([5, 5]),
        ]);

        if ($validator->fails()) {
            return redirect()->route('home', ["#footer"])
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->save();

        $str = "CNCT";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $contact->id;
        $contact->unique_code = $uid;
        $contact->save();

        return redirect()->route('home', ["#footer"])->with('success', 'Your quote has been submitted successfully, wait for the response.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
