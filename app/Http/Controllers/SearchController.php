<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\Ads;
use App\Business;
use App\BusinessCategory;
use App\Category;
use App\City;
use App\Http\Controllers\Helper\HelperController;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $helper = new HelperController();

        $find = $helper->get_find($request->find);
      
            $search_results = array();
            if ($find['type'] == 'keywords_search') {
            $search_results = Ads::where('title', 'LIKE', '%' . $find['keywords'] . '%')->get();
            } else if ($find['type'] == 'category_search') {

                
                $adBusinessID = AdCategory::where('category_id', $find['category']['id'])->pluck('ad_id');
                $search_results = Ads::findMany($adBusinessID);

                }
                
            
        $data = $helper->main_menu_data();
        $data['keywords'] = $find['keywords'];
     
        $data['search_results'] = $search_results;

        return view('frontend.search', compact('data'));
    }


    public function set_search_preferences($category, $city)
    {
        $helper = new HelperController();
        if ($category != null)
            $helper->set_category_preferences($category);
        // if ($city != null)
        //     $pref_city = $helper->set_location_preferences($city);
        // else
        //     $pref_city = 'Abeka-Lapaz, Accra';

    }

    // public function autocomplete_locations(Request $request)
    // {
    //     $data = Town::select("name")
    //         ->where("name", "LIKE", "%{$request->input('query')}%")
    //         ->take('10')
    //         ->get('name');

    //     foreach ($data as $key => $d) {
    //         $town = Town::where('name', $data[$key]['name'])->first()->city_id;
    //         $city = City::where('id', $town)->first()->name;
    //         $data[$key]['name'] = $data[$key]['name'] . ', ' . $city;
    //     }

    //     if (count($data) == 0) {
    //         $helper = new HelperController();
    //         $data = City::where("name", "LIKE", "%{$request->input('query')}%")
    //             ->take('10')
    //             ->get('name');
    //     }

    //     return response()->json($data);
    // }

    public function autocomplete_keyword(Request $request)
    {
        $data = Category::select("name")
            ->where("name", "LIKE", "%{$request->input('query')}%")
            ->take('10')
            ->get('name');


        // if (count($data) == 0) {
        //     $helper = new HelperController();
        //     $town_id = Town::where('name', $helper->parse_town($request->location))->first()->id;
        //     $data = Business::select("name")
        //         ->where("town_id", $town_id)
        //         ->where("name", "LIKE", "%{$request->input('query')}%")
        //         ->take('10')
        //         ->get('name');
        // }
        return response()->json($data);
    }

    public function autocomplete_business(Request $request)
    {
        $data = Business::select("name")
            ->where("name", "LIKE", "%{$request->input('query')}%")
            ->take('10')
            ->get('name');

        return response()->json($data);
    }

    // public function autocomplete_city(Request $request)
    // {

    //     $data = City::where("name", "LIKE", "%{$request->input('query')}%")
    //         ->take('10')
    //         ->get('name');

    //     return response()->json($data);
    // }

    // public function autocomplete_town(Request $request)
    // {
    //     $data = Town::where("name", "LIKE", "%{$request->input('query')}%")
    //         ->take('10')
    //         ->get('name');

    //     return response()->json($data);
    // }

    // public function list_cities(Request $request)
    // {
    //     $data = Town::select('name', 'id')
    //         ->where("city_id", $request->city)
    //         ->take('10')
    //         ->get();

    //     return response()->json($data);
    // }
}
