<?php

namespace App\Http\Controllers;

use File;
use Image;
use Session;
use Storage;
use App\City;
use App\Business;
use App\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::all();
        return view('backend.business.index', compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BusinessCategory::all();
        return view('backend.business.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $business = new Business();

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $business->name = $request->name;
        $business->description = $request->description;
        $business->message = $request->message;
        $business->url = $request->url;
        $business->phone = $request->phone;
        $business->latitude = $request->latitude;
        $business->longitude = $request->longitude;
        $business->category_id = $request->category_id;
        $business->hours = $request->hours;

        if ($validator->passes()) {

            $business->save();

            if ($request->file('upload')) {
                foreach ($request->file('upload') as $key => $value) {
                    $cover = $value;
                    $extension = $cover->getClientOriginalExtension();
                    $imagename = 'business_' . $key . '_' . time() . '.' . $extension;
                    \Illuminate\Support\Facades\Storage::disk('public')->put($imagename, File::get($cover));

                    $image = new \App\Image();
                    $image->images = $imagename;
                    $image->business_id = $business->id;
                    $image->save();
                }
            }

            Session::flash('success', 'Business has been added successfully.');
            //Session::flash('info', 'Tenant will be recieving an email for the account confirmation  ');
            return redirect()->route('individual.business.index');
        } else {

            Session::flash('error', 'Fields with * must be filled.');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = Business::find($id);
        $category = BusinessCategory::all();
        return view('backend.business.edit', compact('business', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $business = Business::find($id);

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $business->name = $request->name;
        $business->description = $request->description;
        $business->message = $request->message;
        $business->url = $request->url;
        $business->phone = $request->phone;
        $business->latitude = $request->latitude;
        $business->longitude = $request->longitude;
        $business->category_id = $request->category_id;
        $business->hours = $request->hours;

        if ($validator->passes()) {
            $business->save();
            Session::flash('success', 'Business has been Updated successfully.');
            //Session::flash('info', 'Tenant will be recieving an email for the account confirmation  ');
            return redirect()->route('business.index');
        } else {

            Session::flash('error', 'Fields with * must be filled.');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Business::where('id', $id)->delete($id);

        Session::flash('success', 'Business has been deleted successfully');
        return redirect()->route('business.index');
    }
}
