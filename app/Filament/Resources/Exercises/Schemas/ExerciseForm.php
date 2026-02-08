<?php

namespace App\Filament\Resources\Exercises\Schemas;

use App\Models\MuscularGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExerciseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section principale : Informations de base
                Section::make(__('fields.exercise.sections.general'))
                    ->description(__('fields.exercise.sections.general_desc'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('fields.exercise.name'))
                            ->required()
                            ->columnSpan('full'), 

                        Textarea::make('description')
                            ->label(__('fields.exercise.description'))
                            ->rows(4)
                            ->required()
                            ->columnSpan('full'),
                    ])
                    ->columns(2), 

                Section::make(__('fields.exercise.sections.settings'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('muscle_group_id')
                                    ->options(MuscularGroup::all()->pluck(['id' => 'name']))
                                    ->required()
                                    ->preload()
                                    ->searchable()
                                    ->label(__('fields.exercise.muscle_group')),
                            ]),
                    ]),
            ]);
    }
}