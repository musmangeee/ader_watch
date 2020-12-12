<?php

namespace App\Http\Controllers\DefaultUser;

use App\BusinessCategory;
use App\BusinessClaim;
use App\BusinessImage;
use App\Category;
use App\City;
use App\Http\Controllers\BusinessImageController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\Image;
use Illuminate\Http\Request;
use App\Business;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function create_business_page()
    {
        $cities = City::all();
        $categories = BusinessCategory::all();
        return view('backend.business.index', compact('cities', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store_business(Request $request)
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
        $business->claimed = 1;
        $business->save();


        foreach ($request->categories as $category) {
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


        \Illuminate\Support\Facades\Auth::user()->assignRole('business');

        return redirect()->route('individual.business.index');
    }


    public function search_results()
    {
        $cities = City::all();
        $categories = BusinessCategory::all();
        return view('backend.review.index', compact('cities', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        $data = new HelperController();
        $data = $data->main_menu_data();
        return view('backend.business.create', compact('cities', 'categories', 'data'));
    }

    public function claim_business($slug)
    {
        $business = Business::where('slug', $slug)->first();
        $data = new HelperController();
        $data = $data->main_menu_data();
        return view('backend.business.claim_business', compact('data', 'business'));
    }

    public function store_claim_business(Request $request)
    {
        $business = Business::where('slug', $request->business_slug)->first();
        $bc = new BusinessClaim();
        $bc->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $bc->business_id = $business->id;
        $bc->role = $request->role;
        $bc->email_username = $request->username;
        $bc->save();

        Session::flash('success', 'Thank you for claiming your business, we are checking your claim, will notify you soon.');
        return redirect('/home');
    }
}
