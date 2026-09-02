<?php

declare(strict_types=1);

namespace App\Actions\Concerns;

use Illuminate\Support\Str;

trait GeneratesUniqueLink
{
    private const LINK_LIFETIME_DAYS = 7;

    protected function freshLink(): array
    {
        return [
            'link' => Str::random(64),
            'expires_at' => now()->addDays(self::LINK_LIFETIME_DAYS),
        ];
    }
}
