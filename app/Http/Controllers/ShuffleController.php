<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use App\Http\Controllers\Helper\HelperController;

class ShuffleController extends Controller
{
    //
    public function index()
    {
        $data = new HelperController;
        $data = $data->main_menu_data();
        $data['ads'] = Ads::inRandomOrder()->with('package')->get();
    
        return view('frontend.shuffle', compact('data'));
    }

}
