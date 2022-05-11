<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{

    public function test()
    {
        return view('test');
    }

    public function table() {
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
                $html .= "<div class='flex bg-red-500'>".$bet->viewer." loose ".$bet->amount." boxs !</div>";
                $bet->winned = false;
            } else {
                $html .= "<div class='flex bg-green'>".$bet->viewer." win ".$bet->amount." boxs !</div>";
                $bet->winned = true;
                $nbWinner = true;
            }
            $bet->save();
            $this->report_bet($bet);
        }

        $html = "<h3>Nombre de gagnant : {$nbWinner}</h3>".$html;

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
