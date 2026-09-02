<?php

declare(strict_types=1);

namespace App\Actions;

use App\Actions\Concerns\GeneratesUniqueLink;
use App\Models\User;

class RegenerateLinkAction
{
    use GeneratesUniqueLink;

    public function regenerateLink(User $user): User
    {
        $user->update($this->freshLink() + ['is_active' => true]);

        return $user;
    }
}
