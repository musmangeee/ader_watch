<?php

namespace App\Http\Controllers\Frontend;

use App\Ads;
use App\Business;
use App\BusinessCategory;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\Review;
use App\Town;

class FrontEndController extends Controller
{


    public function index()
    {
        $helper = new HelperController();
        $pref_wallpaper = $helper->get_prefer_wallpaper();
        $data = $helper->main_menu_data();
        $data['pref_wallpaper'] = $pref_wallpaper;
        $data['cities'] = City::all();
        $data['random_categories'] = Category::all()->random(4);
        //$data['recent_town_business_review'] = Review::whereIn('business_id', Business::where('town_id', $data['pref_town']->id)->get())->latest('created_at')->get()->unique('business_id')->take(9);
        $data['categories'] = Category::all();
        $data['ads'] = Ads::all()->take(8);
        //dd($data['ads']);

        return view('frontend.index', compact('data'));
    }


    public function all_cities()
    {

        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $cities = City::all();

        return view('frontend.cities', compact('cities', 'data'));
    }



}
