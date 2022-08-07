<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{

    public function submit(Request $request)
    {
        $game = new Game();
        $game->user_id = Auth::user()->id;
        $game->name = $request->input('room_name');
        $game->number_place = $request->input('room_places');
        $game->save();
        return redirect(route('room.play', ['idRoom' => $game->id]));
    }

    public function play(Request $request)
    {
        $idRoom = $request->query('idRoom');
        $game = Game::query()->where('id', $idRoom)->get()->first();
        if (Auth::user()->id == $game->user_id) {
            return view('table.TwitchTable', compact('game'));
        } else {
            $twitch_channel = $game->user->name;
            return view('errors.403', compact('twitch_channel'));
        }
    }

    public function playAsGuest(Request $request)
    {
        $idRoom = $request->query('idRoom');
        $game = Game::query()->where('id', $idRoom)->get()->first();
        $guest = true;
        $participant = false;
        if ($game->participants()->where('user_id', Auth::user()->id)->get()
                ->first() != null) {
            $participant = true;
        }
        if (Auth::user()->hasRole('viewer')) {
            return view('table.table', compact('participant', 'guest', 'idRoom'));
        } else {
            $twitch_channel = $game->user->name;
            return view('errors.403', compact('twitch_channel'));
        }
    }

    public function sit_at_table(Request $request)
    {
        $room = $request->query('roomid');
        $game = Game::query()->where('id', $room)->get()->first();
        if ($game->participants()->where('user_id', Auth::user()->id)->get()
                ->first() != null) {
            return 3;
        }
        if ($game->participants()->count() >= $game->number_place) {
            return 2;
        }
        if (!Auth::user()->places()->find($room)) {
            Auth::user()->places()->attach($room);
            return 0;
        } else {
            return 1;
        }
    }

    public function test()
    {
        return view('test');
    }

    public function table()
    {
        return view('table.table');
    }

    public function form_result_addbet(Request $request)
    {
        if ($this->addBet(1, $request->input('pseudo'), $request->input('amount'), $request->input('chiffre'))) {
            return redirect(route('test'));
        } else {
            return 'ERROR !!';
        }
    }

    public function spinRoulette(Request $request)
    {
        $game = Game::query()->find($request->query('game_id'))->get()[0];
        $num = rand(0, 0);
        $game->number = $num;
        $game->save();
        return $num;
    }

    public function verif_bet_for_game(Request $request)
    {
        $game = Game::query()->find($request->query('game_id'))->get()[0];
        $nbWinner = 0;
        $html = "";
        foreach ($game->bets as $bet) {
            if ($bet->number != $game->number) {
                $html .= "<div class='flex bg-red-500'>" . $bet->viewer . " loose " . $bet->amount . " boxs !</div>";
                $bet->winned = false;
            } else {
                $html .= "<div class='flex bg-green'>" . $bet->viewer . " win " . $bet->amount . " boxs !</div>";
                $bet->winned = true;
                $nbWinner = true;
            }
            $bet->save();
            $this->report_bet($bet);
        }

        $html = "<h3>Nombre de gagnant : {$nbWinner}</h3>" . $html;

        return $html;
    }

    private function addBet($game_id, string $pseudo, int $amount, int $number)
    {
        $bet = new Bet();
        $bet->game_id = $game_id;
        $bet->viewer = $pseudo;
        $bet->amount = $amount;
        $bet->number = $number;
        return $bet->save();
    }

    public function report_bet(Bet $bet)
    {
        $url = (($bet->winned) ?
            'https://wapi.wizebot.tv/api/currency/' . 'c6b3aa51b4233e4ba07e3b5e4b768f05' . '/action/add/' . $bet->viewer . '/' . $bet->amount
            : 'https://wapi.wizebot.tv/api/currency/' . 'c6b3aa51b4233e4ba07e3b5e4b768f05' . '/action/remove/' . $bet->viewer . '/' . $bet->amount . '/0');
        $response = Http::post($url);
        if ($response->status() != 200) {
            dd($response, $url);
        }
    }
}
