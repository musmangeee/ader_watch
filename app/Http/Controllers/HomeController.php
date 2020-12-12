<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCategory;
use App\City;
use App\Http\Controllers\Helper\HelperController;
use App\Mail\VerifyEmail;
use App\Review;
use App\Town;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        return view('backend.index', compact('data'));
    }

     
}
