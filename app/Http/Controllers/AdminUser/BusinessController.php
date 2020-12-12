<?php

namespace App\Http\Controllers\AdminUser;

use App\City;
use App\Image;
use App\Business;
use App\Category;
use App\BusinessImage;
use App\BusinessCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
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
        return view('admin.business.index', compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Business::all();
        $cities = City::all();
        $categories = Category::all();
        return view('admin.business.create', compact('category', 'cities', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
        ]);




        unset($data['images']);
        unset($data['categoires']);
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = strtolower(str_replace(' ', '-', preg_replace("/[^ \w]+/", "", $request->name)));
        $business = Business::create($data);
        $business->save();


        foreach($request->categories as $category)
        {
            $bc = new BusinessCategory();
            $bc->business_id = $business->id;
            $bc->category_id = $category;
            $bc->save();
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $cover = $value;
                $extension = $cover->getClientOriginalExtension();
                $imagename = 'business_' . $key . '_' . time() . '.' . $extension;
                \Illuminate\Support\Facades\Storage::disk('public')->put($imagename, File::get($cover));

                $image = Image::create([
                    'name' => $imagename,
                ]);
                $business_image = BusinessImage::create([
                    'business_id' => $business->id,
                    'image_id' => $image->id
                ]);
            }
        }


        return redirect()->route('business.index');
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


    public function verify_business(Request $request)
    {
        $b = Business::where('id', $request->business_id)->first();
        $b->status = 1;
        $b->save();

        Session::flash('success', 'Business has been verified successfully.');
        return redirect()->back();
    }


}
