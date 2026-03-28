<?php

namespace App\Filament\Resources\Sessions\Schemas;

use App\Models\Difficulty;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SessionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('fields.name'))
                    ->required(),

                TextInput::make('description')
                    ->label(__('fields.description')),

                 Select::make('difficulty_id')
                    ->relationship('difficulty', 'name')
                    ->options(fn() => Difficulty::pluck('name', 'id'))
                    ->required()
                    ->label(__('fields.exercise.difficulty')),

                Select::make('exercises')
                    ->relationship('exercises', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->label(__('fields.sessions.exercises_name'))
            ]);
    }
}
