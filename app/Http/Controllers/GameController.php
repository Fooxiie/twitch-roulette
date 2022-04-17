<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function test() {
        return view('test');
    }

    public function form_result_addbet(Request $request) {
        if ($this->addBet(1, $request->input('pseudo'), $request->input('amount'), $request->input('chiffre'))) {
            return redirect(route('test'));
        } else {
            return 'ERROR !!';
        }
    }

    public function spinRoulette(Request $request) {
        $game = Game::query()->find($request->query('game_id'))->get()[0];
        $num = rand(0, 37);
        $game->number = $num;
        $game->save();
        return $num;
    }

    public function verif_bet_for_game(Request $request) {
        $game = Game::query()->find($request->query('game_id'))->get()[0];
        $nbWinner = 0;
        foreach ($game->bets as $bet) {
            if ($bet->number != $game->number) {
                $bet->winned = false;
            } else {
                $bet->winned = true;
                $nbWinner = true;
            }
        }
        return $nbWinner;
    }

    private function addBet($game_id, string $pseudo, int $amount, int $number) {
        $bet = new Bet();
        $bet->game_id = $game_id;
        $bet->viewer = $pseudo;
        $bet->amount = $amount;
        $bet->number = $number;
        return $bet->save();
    }
}
