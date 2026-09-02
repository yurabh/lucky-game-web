<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Сторінка А</title>
</head>

<body>
<h2>Вітаємо, {{ $user->username }}!</h2>
<p>Ваше унікальне посилання діє до: {{ $user->expires_at->format('Y-m-d H:i:s') }}</p>

<div style="display: flex; gap: 10px;">
    <form action="{{ route('game.lucky', $user->link) }}" method="POST">
        @csrf
        <button type="submit">Imfeelinglucky</button>
    </form>

    <form action="{{ route('game.history', $user->link) }}" method="POST">
        @csrf
        <button type="submit">History</button>
    </form>

    <form action="{{ route('game.regenerate', $user->link) }}" method="POST">
        @csrf
        <button type="submit">Regenerate Link</button>
    </form>

    <form action="{{ route('game.deactivate', $user->link) }}" method="POST">
        @csrf
        <button type="submit">Deactivate Link</button>
    </form>
</div>

@if ($gameResult = session('gameResult'))
    <div style="margin-top: 20px; padding: 10px; border: 1px solid green; background: #e6ffe6;">
        <h3>Результат гри:</h3>
        <p>Рандомне число: <b>{{ $gameResult->random_number }}</b></p>
        <p>Результат: <b>{{ $gameResult->result->value }}</b></p>
        <p>Сума виграшу: <b>{{ $gameResult->win_amount }} грн</b></p>
    </div>
@endif

@if ($history = session('history'))
    <div style="margin-top: 20px; padding: 10px; border: 1px solid #ccc;">
        <h3>Історія останніх 3-х спроб:</h3>
        <ul>
            @forelse ($history as $game)
                <li>
                    Число: <b>{{ $game->random_number }}</b> |
                    Результат: <b>{{ $game->result->value }}</b> |
                    Виграш: <b>{{ $game->win_amount }} грн</b>
                </li>
            @empty
                <li>Спроб ще не було.</li>
            @endforelse
        </ul>
    </div>
@endif
</body>
</html>
