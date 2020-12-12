<?php

namespace App\Http\Controllers\AdminUser;

use App\Business;
use App\BusinessClaim;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusinessClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = BusinessClaim::all();
        return view('admin.claims.index', compact('claims'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function claim_business(Request $request)
    {
        $business = Business::where('id', $request->business_id)->first();
        $business->user_id = $request->user_id;
        $business->claimed = 1;
        $business->save();
        $user = User::where('id',$request->user_id)->first();
        $user->assignRole('business');
        $claim  = BusinessClaim::where('id', $request->claim_id)->first();
        $claim->status  = 1;
        $claim->save();

        Session::flash('success', 'Business claimed successfully.');
        return redirect()->back();
    }
}

