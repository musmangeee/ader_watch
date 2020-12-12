<?php

namespace App\Http\Controllers\DefaultUser;

use App\Business;
use App\Http\Controllers\Controller;
use App\Image;
use App\Review;
use App\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\BusinessCategory;
use App\City;
use App\Http\Controllers\Helper\HelperController;

class ReviewController extends Controller
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

    public function index()
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $reviews = Review::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(20)->get();
        return view('backend.review.index', compact('reviews', 'data'));
    }

    public function write_a_review_page($slug)
    {
        if (is_numeric($slug))
            $business = Business::where('id', $slug)->first();
        else
            $business = Business::where('slug', $slug)->first();
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        return view('backend.review.write_a_review_form', compact('business', 'data'));
    }

    /**
     * @param Request $request
     */

    public function postReview(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->stars = $request->review_value;
        $review->business_id = $request->business_id;
        $review->text = $request->message;

        $review->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $cover = $value;
                $extension = $cover->getClientOriginalExtension();
                $imagename = 'review_' . $key . '_' . time() . '.' . $extension;
                $path = \Illuminate\Support\Facades\Storage::disk('public')->put($imagename, File::get($cover));


                $image = Image::create([
                    'name' => $imagename,
                ]);
                $review_image = ReviewImage::create([
                    'review_id' => $review->id,
                    'image_id' => $image->id
                ]);

            }
        }
        return redirect('my/reviews');
    }

    public function writeareview()
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $city_business = Business::where('city_id', 1)->get();
        $reviews = Review::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(20)->get();
        return view('backend.review.write_a_review', compact('reviews', 'data', 'city_business'));
    }

    public function saveAjaxReview(Request $request)
    {
        $review = new Review($request->all());

        return response()->json(['message' => 'Review Added Successfully!']);
    }


}
