<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
  public function __construct(){
      $this->middleware('guest:admin');
  }

  public function showLoginForm(){
    return view('auth.admin-login');
  }

  public function login(){
    //validating the form data
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required1min:6',
      ]);
    //attempt to log the user in (search if credentials matches with someone, second parameter remembers  the credentials)
    //returns true if succsesful
    //specify the guard
    if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password],$request->remember)){
      //if succsesful, Redirect, intended tracks the intended route the wanted
      return redirect()->intended(route('admin.dashboard'));
    }
    else{
      return redirect()->back()->withInput($request->only('email','remember'));
    }
    //if not, redirect again
    return true;
  }
}
