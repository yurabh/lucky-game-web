<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\GameResultStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
        'random_number',
        'result',
        'win_amount',
    ];

    protected function casts(): array
    {
        return [
            'result' => GameResultStatus::class,
            'win_amount' => 'decimal:2',
        ];
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
