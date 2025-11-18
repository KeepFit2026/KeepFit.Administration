<?php

namespace App\Constants\Enum;

enum UserRole: int
{
    case ADMIN = 1;
    case STUDENT = 2;
    case TEACHER = 3;

    public static function fromMixed(string|int $value): ?self 
    {
        if(is_numeric($value)) return self::tryFrom((int)$value);

        $value = strtoupper($value);
        return constant("self::$value") ?? null;
    }
}
