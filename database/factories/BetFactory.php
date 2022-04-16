<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bet>
 */
class BetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'game_id' => Game::factory(),
            'viewer' => $this->faker->userName(),
            'amount' => $this->faker->numberBetween(1, 500000),
            'winned' => $this->faker->numberBetween(0, 1),
            'number' => $this->faker->numberBetween(0, 37),
        ];
    }
}
