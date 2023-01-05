<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPost(adminLogin $request){
        // Attempt to log the user in
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            if ((auth('web')->user()->user_type != 'admin') && (auth('web')->user()->user_type != 'superadmin')) {
                flash(trans('admin.loginErrorAdmin'))->error();
                Auth::guard('web')->logout();
                return redirect()->back();
            }

            flash(trans('admin.loginSuccess'))->success();
            return redirect()->intended(route('admin.dashboard'));
        }

        // if unsuccessful
        flash(trans('admin.loginError'))->error();
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    //
    public function login()
    {
        return view('admin.auth.login');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->intended(route('admin.login'));
    }
}
