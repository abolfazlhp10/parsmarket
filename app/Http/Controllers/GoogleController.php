<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function next()
    {
        return Socialite::driver('google')->redirect();
    }

    public function Callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $siteUser = User::where('email', $user->email)->first();

        if ($siteUser) {
            Auth::loginUsingId($siteUser->id);
            return redirect(route('index'));
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('password')
            ]);

            if ($newUser) {
                $newUser->email_verified_at = now();
                $newUser->save();
            }

            session()->put('email', $newUser->email);

            Auth::loginUsingId($newUser->id);
            return redirect(route('index'));
        }
    }
}
