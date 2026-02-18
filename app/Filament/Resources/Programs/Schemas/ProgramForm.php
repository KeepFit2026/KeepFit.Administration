<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section principale : Informations de base
                Section::make(__('fields.programs.sections.general'))
                    ->description(__('fields.programs.sections.general_desc'))
                    ->schema([
                        TextInput::make('Name')
                            ->label(__('fields.programs.name'))
                            ->required()
                            ->columnSpan('full'), 

                        Textarea::make('Description')
                            ->label(__('fields.programs.description'))
                            ->rows(4)
                            ->required()
                            ->columnSpan('full'),
                    ])
                    ->columns(2), 

                Section::make(__('fields.programs.sections.settings'))
                    ->schema([
                        Grid::make(2)   
                            ->schema([
                               Toggle::make('IsActive')
                                    ->label(__('fields.programs.sections.isActive'))
                            ]),
                    ]),
            ]);
    }
}