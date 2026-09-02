<?php

declare(strict_types=1);

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Middleware\EnsureValidGameLink;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'index'])->name('register.index');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::middleware(EnsureValidGameLink::class)
    ->prefix('page-a/{link}')
    ->name('game.')
    ->group(function (): void {
        Route::get('/', [GameController::class, 'show'])->name('show');
        Route::post('/lucky', [GameController::class, 'lucky'])->name('lucky');
        Route::post('/history', [GameController::class, 'history'])->name('history');
        Route::post('/regenerate', [GameController::class, 'regenerate'])->name('regenerate');
        Route::post('/deactivate', [GameController::class, 'deactivate'])->name('deactivate');
    });
