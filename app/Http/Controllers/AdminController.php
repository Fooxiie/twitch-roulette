<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use React\Dns\Query\TcpTransportExecutor;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin.admin');
    }

    public function deleteRoom(Request $request)
    {
        $result =   Game::query()->find($request->query('roomid'));
        if ($result) {
            $result->delete();
        }
        return back();
    }

    public function deleteUser(Request $request) {
        $result = User::query()->find($request->query('userid'));
        if ($result) {
            $result->delete();
        }
        return back();
    }
}
