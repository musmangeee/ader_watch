<?php

namespace App\Http\Controllers\DefaultUser;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function setting()
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $cities = City::all();
        return view('backend.profile.edit', compact('data','cities'));
    }
}
