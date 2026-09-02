<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'phone',
        'link',
        'expires_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function game(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function scopeWithValidLink(Builder $query, string $link): Builder
    {
        return $query->where('link', $link)
            ->where('is_active', true)
            ->where('expires_at', '>', now());
    }
}
