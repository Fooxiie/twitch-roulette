<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
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
            return redirect(route('dashboard'));
        } else {
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = Crypt::encryptString($user->getEmail());
            $newUser->password = "nonono";
            $newUser->avatar = $user->getAvatar();
            $newUser->twitch_token = $user->getId();
            $newUser->save();
            $newUser->assignRole('viewer');
            Auth::login($newUser);
            return redirect(route('dashboard'));
        }
    }

    public function connected()
    {
        return view('dashboard');
    }

    public function profil(Request $request)
    {
        if ($request->query('error')) {
            $error = $request->query('error');
            return view('auth.twitch.profil', compact('error'));
        } elseif ($request->query('success')) {
            $success = $request->query('success');
            return view('auth.twitch.profil', compact('success'));
        }
        return view('auth.twitch.profil');
    }

    public function save(Request $request)
    {
        $code = $request->input('wizebotkey');
        Auth::user()->wizebot_key = $code;
        Auth::user()->save();
        return redirect(route('auth.twitch.profil'));
    }

    public function getJeton()
    {
        if (Auth::check()) {
            $url = 'https://wapi.wizebot.tv/api/currency/' . 'c6b3aa51b4233e4ba07e3b5e4b768f05' . '/get/' . Auth::user()->name;
            $response = Http::post($url);
            if ($response->status() != 200) {
                dd($response, $url);
            }
            return json_decode($response->body())->currency;
        }
    }

    public function activeKey(Request $request)
    {
        if (Key::query()
                ->where('key', $request->input('key'))
                ->where('used', '0')
                ->get()->count() > 0) {
            $key = Key::query()->where('key', $request->input('key'))->get()->first();
            switch ($key->type) {
                case "addViewer":
                    Auth::user()->assignRole('viewer');
                    break;
                case "addModerator":
                    Auth::user()->assignRole('moderator');
                    break;
                case "addStreamer":
                    Auth::user()->assignRole('streamer');
                    break;
                case "addSuperadmin":
                    Auth::user()->assignRole('super-admin');
                    break;
            }
            $key->used = 1;
            $key->usedby = Auth::user()->id;
            $key->save();
            return redirect(route('auth.twitch.profil', ['success' => __('custom.keyactivated')]));
        } else {
            return redirect(route('auth.twitch.profil', ['error' => __('custom.keynotexist')]));
        }
    }
}
