<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('authenticate');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|between:8,15|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json($request->all());
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'pw' => 'bail|required',
            'remember' => 'present',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->pw], $request->remember)) {
            $request->session()->regenerate();
        }

        return response()->json($request->all());
    }
}
