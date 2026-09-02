<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use App\Actions\DeactivateLinkAction;
use App\Actions\PlayLuckyGameAction;
use App\Actions\RegenerateLinkAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    private const HISTORY_SIZE = 3;

    public function show(User $user): View
    {
        return view('game', ['user' => $user]);
    }

    public function lucky(User $user, PlayLuckyGameAction $action): RedirectResponse
    {
        return redirect()
            ->route('game.show', $user->link)
            ->with('gameResult', $action->playLucky($user));
    }

    public function history(User $user): RedirectResponse
    {
        return redirect()
            ->route('game.show', $user->link)
            ->with('history', $user->game()
                ->latest('id')
                ->limit(self::HISTORY_SIZE)
                ->get());
    }

    public function regenerate(User $user, RegenerateLinkAction $action): RedirectResponse
    {
        return redirect()->route('game.show', $action->regenerateLink($user)->link);
    }

    public function deactivate(User $user, DeactivateLinkAction $action): RedirectResponse
    {
        $action->deactivateLink($user);

        return redirect()->route('register.index');
    }
}
