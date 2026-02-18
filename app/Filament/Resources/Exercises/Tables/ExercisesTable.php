<?php

namespace App\Filament\Resources\Exercises\Tables;

use App\Enum\Difficulty;
use App\Models\MuscularGroup;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExercisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')
                    ->searchable()
                    ->label(__('fields.name')),

                TextColumn::make('muscleGroup.Name')
                    ->searchable()
                    ->label(__('fields.exercise.muscle_group')),

                TextColumn::make('difficulty.name')
                    ->badge()
                    ->label(__('fields.exercise.difficulty'))
                    ->getStateUsing(fn($record): string => Difficulty::from($record->Difficulty)->getLabel())
            ])
            ->filters([
                SelectFilter::make('difficulty')
                    ->options(Difficulty::class)
                    ->label(__('fields.exercise.difficulty'))
                    ->attribute('difficulty'),

                SelectFilter::make('muscleGroupId')
                    ->options(MuscularGroup::pluck('Name', 'Id'))
                    ->label(__('fields.exercise.muscle_group'))
                    ->attribute('muscleGroupId')
            ])
            ->actions([
                 Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->tooltip(__('tooltip.view')),

                EditAction::make()
                    ->tooltip(__('tooltip.edit'))
                    ->label(''),

                DeleteAction::make()
                    ->tooltip(__('tooltip.delete'))
                    ->label(''),
            ])
            ->toolbarActions([

            ]);
    }
}
