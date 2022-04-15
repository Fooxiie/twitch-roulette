<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class TwitchController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('twitch')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('twitch')->user();
        } catch (InvalidStateException) {
            return redirect(route('auth.twitch.redirect'));
        }
        $isUser = User::query()->where('twitch_token', $user->id)->first();
        if ($isUser) {
            Auth::loginUsingId($isUser->id);
            return redirect(route('auth.twitch.connected'));
        } else {
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = "nonono";
            $newUser->avatar = $user->getAvatar();
            $newUser->twitch_token = $user->getId();
            $newUser->save();
            Auth::login($newUser);
            return redirect(route('auth.twitch.connected'));
        }
    }

    public function connected()
    {
        return view('auth.twitch.connected');
    }

    public function profil() {
        return view('auth.twitch.profil');
    }

    public function save(Request $request) {
        $code = $request->input('wizebotkey');
        Auth::user()->wizebot_key = $code;
        Auth::user()->save();
        return redirect(route('auth.twitch.profil'));
    }
}
