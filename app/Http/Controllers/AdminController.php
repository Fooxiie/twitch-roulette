<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Key;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(Request $request)
    {
        if ($request->query('keyadded')) {
            $keyadded = $request->query('keyadded');
            return view('admin.admin', compact('keyadded'));
        }
        return view('admin.admin');
    }

    public function deleteRoom(Request $request)
    {
        $result = Game::query()->find($request->query('roomid'));
        if ($result) {
            $result->delete();
        }
        return back();
    }

    public function deleteUser(Request $request)
    {
        $result = User::query()->find($request->query('userid'));
        if ($result) {
            $result->delete();
        }
        return back();
    }

    public function editUser(Request $request)
    {
        $user = User::query()->find($request->query('userid'));
        return view('admin.adminUser', compact('user'));
    }

    public function editUserSubmit(Request $request)
    {
        $user = User::query()->find($request->query('userid'));
        $user->syncRoles($request->input('role'));
        return redirect(route('admin.show'));
    }

    public function keyGenerateSubmit(Request $request)
    {
        $key = new Key();
        $key->key = Key::generateKey();
        $key->type = $request->input('typeKey');
        $key->save();
        return redirect(route('admin.show', ['keyadded' => $key->key]));
    }
}
