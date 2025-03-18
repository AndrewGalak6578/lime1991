<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function showLoginForm()
    {
				echo "Login: test@test.ru<br>Password: admin<br>Hash: ".Hash::make('admin');
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate( [
            'email'   => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if($request->remember){
                Cache::put('remember_login',['email' => $request->email, 'password' => $request->password], 60000);
            }
            return redirect(route('admin.dashboard'));
        }

        return back()->with('error','Sorry! Credentials Mismatch.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
