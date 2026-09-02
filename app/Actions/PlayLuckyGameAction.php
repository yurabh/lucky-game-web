<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\GameResultStatus;
use App\Models\Game;
use App\Models\User;

class PlayLuckyGameAction
{
    private const WIN_RATES = [
        900 => 0.70,
        600 => 0.50,
        300 => 0.30,
        0 => 0.10,
    ];

    public function playLucky(User $user): Game
    {
        $randomNumber = random_int(1, 1000);
        $status = $randomNumber % 2 === 0 ? GameResultStatus::Win : GameResultStatus::Lose;
        return $user->game()->create([
            'random_number' => $randomNumber,
            'result' => $status,
            'win_amount' => $status === GameResultStatus::Win
                ? round($randomNumber * $this->winRate($randomNumber), 2)
                : 0,
        ]);
    }

    private function winRate(int $randomNumber): float
    {
        foreach (self::WIN_RATES as $lowerBound => $rate) {
            if ($randomNumber > $lowerBound) {
                return $rate;
            }
        }

        return 0.0;
    }
}
