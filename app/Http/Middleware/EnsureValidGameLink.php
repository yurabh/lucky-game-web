<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidGameLink
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::query()
            ->withValidLink((string)$request->route('link'))
            ->first();

        if ($user === null) {
            return redirect()
                ->route('register.index')
                ->with('error', 'Посилання недійсне або термін його дії (7 днів) закінчився.');
        }
        $request->route()->setParameter('link', $user);

        return $next($request);
    }
}
