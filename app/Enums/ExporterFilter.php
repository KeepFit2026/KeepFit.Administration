<?php

namespace App\Enums;

use App\Filament\Exports\ExerciseExporter;
use App\Filament\Exports\LoginExporter;
use Filament\Support\Contracts\HasLabel;

enum ExporterFilter: string implements HasLabel
{
    case EXERCISE = ExerciseExporter::class;
    case LOGIN  = LoginExporter::class;

    public function getLabel(): ?string
    {
        return match($this) {
            self::EXERCISE => 'Exercice',
            self::LOGIN => 'Login',
        };
    }
}
