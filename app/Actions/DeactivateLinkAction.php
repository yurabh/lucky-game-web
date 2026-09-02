<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;

class DeactivateLinkAction
{
    public function deactivateLink(User $user): void
    {
        $user->update(['is_active' => false]);
    }
}
