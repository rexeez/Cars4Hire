<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/');
    }


    function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    function formEditProfile(){
        $user_id = auth()->user()->id;

        $user = DB::table('users')
                ->select('*')
                ->where('id', $user_id)
                ->first();

        return view('editprofile', compact('user'));
    }

    function updateUser(Request $request){
        $rules = [
            'password' => 'confirmed'
        ];

        $message = [
            'password.confirmed' => 'Confirmation password does not match.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        DB::table('users')
        ->where('id', $request->userID)
        ->update([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/home');
    }

}
