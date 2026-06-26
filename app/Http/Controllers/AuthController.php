<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        
        if(Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->with('toast-error', 'The credentials do not match our records!')
                ->withInput($request->only('username'));
        }

        $credentials = $validator->validated();

        if(auth()->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user()->load('role');

            return redirect()->route('dashboard')->with('toast-success', 'Welcome to Gatepass System '. $user->first_name);
        }

        return redirect()
                ->route('login')
                ->with('toast-error', 'The credentials do not match our records!')
                ->withInput($request->only('username'));

    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/')->with('toast-success', 'Logged out successfully.');
    }
}
