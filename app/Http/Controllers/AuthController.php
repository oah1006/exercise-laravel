<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{   
    public function showLogin() {
        $title = 'Login User';

        return view('auth/login', compact('title'));
    }

    public function userLogin(LoginUserRequest $request) {
        $loginUser = $request->validated();

        $user = User::where('email', $request->email)->first();

        // if ($user && Hash::check($request->password, $user->password)) {
        //     Auth::login($user);
        //     return redirect()->route('users.index');
        // }

        $informationUser = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = false;
        if ($request->remember) {
            $remember = true;
        }
        
        if (Auth::attempt($informationUser, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('users.index');
        }   

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);

    }

    public function showRegister() {
        $title = 'Register User';

        return view('auth/register', compact('title'));
    }

    public function create(RegisterUserRequest $request) {
        
        $checkedUser = $request->validated();
        $checkedUser['password'] = Hash::make($checkedUser['password']);

        $user = User::create($checkedUser);
        Auth::login($user);
        
        return redirect()->route('users.index'); 
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
        
        return redirect()->route('auth.login');
    }
}
