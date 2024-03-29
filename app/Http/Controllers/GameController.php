<?php

namespace App\Http\Controllers;

use App\Events\BetAdded;
use App\Events\JoinRoom;
use App\Models\Bet;
use App\Models\Game;
use App\Models\User;
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
            event(new JoinRoom(Auth::user()->name, 'roomRoulette-' . $game->id));
            return 0;
        } else {
            return 1;
        }
    }

    public function count_sit_table(Request $request)
    {
        $room = Game::query()->where('id', $request->query('roomId'))
            ->get()->first();
        return $room->participants()->count();
    }

    public function print_participant(Request $request)
    {
        $url = "https://wapi.wizebot.tv/api/currency/";
        $game = Game::query()->where('id', $request->query('game_id'))
            ->get()->first();
        $url .= $game->user->wizebot_key . "/get/" . $request->query('pseudo');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $money = number_format(json_decode($output)->currency);
        return '<div class="bg-red-700 inline-block p-3 text-white
                    rounded-lg" id="' . $request->query('pseudo') . '">
                    <span><a href="#" onclick="removePlayer(' . $request->query('pseudo') . ')">✖</a></span>
                <span class="font-bold">' . $request->query('pseudo') . '</span><br/>
                    ' . $money . '💰
                </div>';
    }

    public function remove_sit(Request $request)
    {
        $name = $request->query('name');
        $idRoom = $request->query('roomId');
        $room = Game::query()->where('id', $idRoom)->get()->first();
        $user = User::query()->where('name', $name)->get()->first();
        if ($room->user_id == Auth::user()->id) {
            $user->places()->detach($room);
        }
        return $room->participants()->count();
    }

    public function submit_bet(Request $request)
    {
        $bets = json_decode($request->query('bets'));
        foreach ($bets as $key => $bet) {
            $bet_to_db = new Bet();
            $bet_to_db->game_id = $request->query('gameid');
            $bet_to_db->viewer_id = Auth::user()->id;
            $bet_to_db->amount = $bet;
            $bet_to_db->number = $key;
            $bet_to_db->save();
        }
        event(new BetAdded('roomRoulette-' . $request->query('gameid'),
            Auth::user()->id, $request->query('gameid')));
        return 0;
    }

    public function get_bet(Request $request)
    {
        $game_id = $request->query('game_id');
        $user_id = $request->query('user_id');

        $game = Game::query()->where('id', $game_id)->get()->first();
        $bets = $game->bets()->where('viewer_id', $user_id)->get();

        foreach ($bets as $bet) {
            $bet->name = User::query()->where('id', $bet->viewer_id)
                ->get()->first()->name;
        }

        return json_encode($bets);
    }

    public function get_all_bet_for_game(Request $request)
    {
        $game_id = $request->query('game_id');
        $game = Game::query()->where('id', $game_id)->get()->first();
        foreach ($game->bets as $bet) {
            $bet->name = User::query()->where('id', $bet->viewer_id)
                ->get()->first()->name;
        }
        return json_encode($game->bets);
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
        if ($this->addBet(1, $request->input('pseudo'),
            $request->input('amount'),
            $request->input('chiffre'))) {
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
