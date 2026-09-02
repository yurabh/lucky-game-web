<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('register');
    }

    public function store(RegisterUserRequest $request, RegisterUserAction $action): RedirectResponse
    {
        $user = $action->registerUser($request->validated());

        return redirect()->route('game.show', $user->link);
    }
}
