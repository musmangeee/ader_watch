<?php

namespace App\Http\Controllers\Frontend;

use App\Business;
use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\BusinessCategory;
use App\City;
use App\Http\Controllers\Helper\HelperController;

class ProfileController extends Controller
{


    public function index($slug)
    {

        $user = User::where('id', $slug)->first();
        $helper = new HelperController();
        $categories = BusinessCategory::all();
        $searched_category = '';
        $pref_categories = $helper->get_category_preferences();
        $cities = City::all();
        $pref_city = $city = $helper->get_location_preferences();
        $city_id = City::where('name', $pref_city)->first()->id;
        $city_business = Business::where('city_id', $city_id)->get()->random(4);

        return view('frontend.profile', compact('user','reviews','categories', 'searched_category', 'city', 'cities', 'pref_city', 'pref_categories', 'city_business'));
    }
}
