<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail\VerifyEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\MustVerifyEmail;

class SignupController extends Controller
{
    public function signup()
    {
        $cities = City::all();
        return view('auth.signup', compact('cities'));
    }

    public function register(Request $request)
    {
        $user =  New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city_id = $request->city_id;
        $user->town_id = $request->town_id;
        $user->address = $request->address;
        $user->save();


        $user->sendEmailVerificationNotification();

//        Mail::to($user)
//            ->send(new VerifyEmail());
        Auth::loginUsingId($user->id);

        return redirect('/home');
    }
}
