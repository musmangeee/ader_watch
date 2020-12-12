<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Package;
use App\Business;
use App\Category;
use App\AdCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Controllers\Helper\HelperController;
use Cartalyst\Stripe\Exception\CardErrorException;

class AdsController extends Controller
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

        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $data['ads'] = Auth::user()->business->ads;

        return view('business.ads.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $categories = Category::all();
        $packages = Package::all();
        return view('business.ads.create', compact('data', 'categories', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $stripe = new Stripe('sk_test_SlKb3iSY2ucy9xuQyIQxzlqr00rhqvJA3y', '2.4.2');


        // dd($stripe);


        $package = Package::where('id', $request->package_id)->first()['price'];

        try {
            $charge = Stripe::charges()->create([
                'amount' => $package,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Thank you for Purchasing  Packaged',
                'receipt_email' => Auth::user()->email,
            ]);
           
            // dd($charge);
            // dd($charge['source']['id']);
           
            $business = Business::where('user_id', Auth::user()->id)->first();

            $data = $request->all();

            unset($data['video']);
            if ($request->hasFile('video')) {
                $cover = $request->file('video');
                $extension = $cover->getClientOriginalExtension();
                $imagename = 'video_' . time() . '.' . $extension;
                \Illuminate\Support\Facades\Storage::disk('public')->put($imagename, File::get($cover));
                $data['video'] = $imagename;
            }
            unset($data['categories']);
            $data['business_id'] = $business->id;
            $data['status'] = 1;
            $ad = Ads::create($data);
            foreach ($request->categories as $category) {
                $bc = new AdCategory();
                $bc->ad_id = $ad->id;
                $bc->category_id = $category;
                $bc->save();
            }

            return redirect('business/ads/')->with('success', 'Ad Created Successfully');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit($ads)
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $ads = Ads::find($ads);
        $categories = Category::all();
        $packages = Package::get('name', 'name')->all();
        return view('business.ads.edit', compact('ads', 'data', 'categories', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $businessAd = Ads::find($id);
        $validator = validator::make($request->all(), [
            'package_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',
            'btn_text' => 'required',
        ]);
        $data = $request->all();
        unset($data['video']);
        if ($request->hasFile('video')) {
            $cover = $request->file('video');
            $extension = $cover->getClientOriginalExtension();
            $imagename = 'video_' . time() . '.' . $extension;
            \Illuminate\Support\Facades\Storage::disk('public')->put($imagename, File::get($cover));
            $data['video'] = $imagename;
        } else {
            $data['video'] = $businessAd->video;
        }
        unset($data['categories']);
        $data['business_id'] = $businessAd->business_id;



        if ($validator->passes()) {

            $ad = $businessAd->update($data);

            foreach ($request->categories as $category) {
                $bc = new AdCategory();
                $bc->ad_id = $businessAd->id;
                $bc->category_id = $category;
                $bc->save();
            }
        }
        return redirect()->route('ads.index')->with('success', 'Ad Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //
        $del = Ads::where('id', $id)->delete();

        Session::flash('success', 'Ad has been deleted successfully');
        return redirect()->route('ads.index');
    }
}
