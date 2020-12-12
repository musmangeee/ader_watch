<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Review;
use Auth;

class ReviewController extends Controller
{
    public function index()
    {
        return view('backend.review.search_business');
    }

    public function write_a_review($id)
    {
        $bid = $id;
        //dd($id);
        return view('backend.review.write_a_review', compact('bid'));
    }
    public function postReview(Request $request)
    {
        dd($request);
        $review = new Review();

        $review->user_id = Auth::user()->id;
        $review->business_id = $request->business_id;
        $review->text = $request->message;

        $review->save();

    }
}
