<?php

use App\Models\Bet;
use App\Models\Game;
use PHPUnit\Framework\TestCase;

class BetTest extends TestCase
{
    public function test_add_bet() {
        $game = Game::all()->first();
        $bet = new Bet();
        $bet->game_id = $game->id;
        $bet->viewer = 'testme';
        $bet->amount = rand(1, 3000);
        $bet->save();

        $this->assertTrue($bet->id != 0);
    }
}
