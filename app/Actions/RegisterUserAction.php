<?php

declare(strict_types=1);

namespace App\Actions;

use App\Actions\Concerns\GeneratesUniqueLink;
use App\Models\User;

class RegisterUserAction
{
    use GeneratesUniqueLink;

    public function registerUser(array $data): User
    {
        return User::create($data + $this->freshLink());
    }
}
