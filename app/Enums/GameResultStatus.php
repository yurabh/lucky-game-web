<?php

declare(strict_types=1);

namespace App\Enums;

enum GameResultStatus: string
{
    case Win = 'Win';
    case Lose = 'Lose';
}
