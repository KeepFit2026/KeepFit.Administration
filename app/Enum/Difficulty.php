<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Difficulty: int implements HasLabel, HasColor
{
    case EASY = 1;
    case MEDIUM = 2;
    case HARD = 3;

    public function getColor(): string|array|null
    {
        return match($this) {
            self::EASY => 'success',
            self::MEDIUM => 'warning',
            self::HARD => 'danger',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match($this){
            self::EASY => __('enum.difficulty.easy'),
            self::MEDIUM => __('enum.difficulty.medium'),
            self::HARD => __('enum.difficulty.hard'),
        };
    }
}