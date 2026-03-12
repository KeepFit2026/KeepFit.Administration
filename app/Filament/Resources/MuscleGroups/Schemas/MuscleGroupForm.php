<?php

namespace App\Filament\Resources\MuscleGroups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MuscleGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('fields.muscular_group.name'))
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
