<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('auth.login');
    }
    public function customLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Auth::user()->update(['last_login_at' => Carbon::now()]);
            Auth::logoutOtherDevices($request->input('password'));
            return redirect()->route('dashboard.index')->withSuccess('Signed in successfully');
        } else {
            return redirect("admin/login")->with('error', 'Login details are not valid');
        }
    }
    public function logout()
    {
        //Session::flush();
        Auth::logout();
        return Redirect('admin/login');
    }

}
