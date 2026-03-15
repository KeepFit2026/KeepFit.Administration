<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum UserRole: int implements HasLabel, HasColor
{
    case STUDENT = 1;
    case ADMIN = 2;
    case TEACHER = 3;

    public function getLabel(): string|Htmlable|null
    {
        return match($this) {
            self::STUDENT => __('enum.role.student'),
            self::ADMIN => __('enum.role.admin'),
            self::TEACHER => __('enum.role.teacher')
        };
    }

    public function getColor(): string|array|null
    {
        return match($this) {
            self::STUDENT => 'secondary',
            self::ADMIN => 'danger',
            self::TEACHER => 'info'
        };
    }
}
