<?php

namespace App\Filament\Resources\MuscleGroups\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MuscleGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable(),

                    TextColumn::make('exercises_count')
                        ->label(__('fields.muscular_group.exercises_count'))
                        ->sortable(),
            ])
            ->filters([

            ])
            ->recordActions([
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ])
            ->toolbarActions([
            ]);
    }
}
