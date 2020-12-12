<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Http\Controllers\Helper\HelperController;
use App\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\View $view
     * @return \Illuminate\Http\Response
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\View $view
     * @return \Illuminate\Http\Response
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\View $view
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\View $view
     * @return \Illuminate\Http\Response
     */
    public function destroy(View $view)
    {
        //
    }


    public function view($id)
    {
        $helper = new HelperController();
        $data = $helper->main_menu_data();
        $data['ad'] = Ads::find($id);
        return view('frontend.view', compact('data'));
    }

    public function add_view(Request $request)
    {
        $find = View::where('user_id', $request->user()->id)
            ->where('ad_id', $request->ad_id)->first();


        if ($find == null) {
            $ad_amount = Ads::find($request['ad_id'])->package['amount_per_view'];
            $data = $request->all();
            $data['reward'] = $ad_amount;
            $view = View::create($data);
            return response()->json([
                'success' => 'Rewarded Successfully!',
                'reward' => $ad_amount
            ]);
        }else{
            return response()->json([
                'success' => 'Ad already viewed!',
                'reward' => 0
            ]);
        }
    }
}
