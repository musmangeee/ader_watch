<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentLoginController extends Controller
{
    Public function showLoginForm(){
	    return view('auth.user_login');
    }
    Public function login(){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $status = Agent::where('email', $request->email)->first();

        if($status->status == 1){
            if (Auth::guard('agent')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                Session::flash('success', 'You have successfully logged into dashboard.');
                // dd('ok');
                return redirect()->intended(route('user_dashboard'));
            } else {
                Session::flash('error', 'Invalid email or password.');
                return redirect()->back()->withInput($request->only('email'));
            }
        }else{
            Session::flash('error', 'Your email is not active please active .');
            return redirect()->back()->withInput($request->only('email'));
        }
    }

}
