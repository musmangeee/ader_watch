<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ads;
use App\Business;
class AddsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $data['ads'] = Ads::all();

        return view('admin.ads.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        $businessAd = Business::find($ads);
        return view('business.ads.edit', compact('businessAd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads)
    {
        $businessAd = Business::find($ads);
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
        $data['business_id'] = $businessAd->id;
        $ad = Ads::create($data);
        foreach($request->categories as $category)
        {
            $bc = new AdCategory();
            $bc->ad_id = $ad->id;
            $bc->category_id = $category;
            $bc->save();
        }


        return redirect()->route('business.ads.index')->with('success', 'Ad Updated Successfully');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        //
        $del = Business::where('id',$ads)->delete($ads);

        Session::flash('success','Ad has been deleted successfully');
        return redirect()->route('business.ads.index');
    }

}
