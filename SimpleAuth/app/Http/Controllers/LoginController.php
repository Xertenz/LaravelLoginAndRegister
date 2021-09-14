<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function check_register(Request $request) {

        $messages = array(
            'confirm_password.same' => 'The password confirmation and password fields must match.'
        );

        $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|email|unique:logins',
            'password' => 'required|min:3',
            'confirm_password' => 'required|min:3|same:password'
        ], $messages);

        $user = new Login();
        $user->username = $request->username;
        $user->email     = $request->email;
        $user->password = Hash::make($request->password) ;
        $query = $user->save();

        if($query) {
            return back()->with('success', 'You has been registered successfully');
        }else{
            return back()->with('fail', 'Something went wrong');
        }

    }

    public function check_login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $user = Login::where('email', '=', $request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                // return back()->with('success', 'User login successfully');
                $request->session()->put('LoggedInUser', $user->id);
                // return redirect(route('auth.profile'));
                return redirect('/profile');
            }else{
                return back()->with('fail', 'Password error for that user.');
            }
        }else{
            return back()->with('fail', 'User Not Found');
        }

    }

    public function auth_profile() {
        if(session()->has('LoggedInUser')) {
            $user = Login::where('id', '=', session()->get('LoggedInUser'))->first();
            return view('auth.profile', compact('user'));

        }

    }

    public function auth_logout() {
        if(session()->has('LoggedInUser')) {
            session()->forget('LoggedInUser');
        }
        return redirect(route('auth.login'));
    }

}
