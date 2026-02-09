<?php

namespace App\Filament\Resources\Exercises\Tables;

use App\Enum\Difficulty;
use App\Models\Exercise;
use App\Models\MuscularGroup;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
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
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('fields.name')),

                TextColumn::make('description')
                    ->label(__('fields.description')),

                TextColumn::make('muscleGroup.name')
                    ->label(__('fields.exercise.muscle_group')),

                TextColumn::make('difficulty')
                    ->badge()
                    ->label(__('fields.exercise.difficulty'))
            ])
            ->filters([
                SelectFilter::make('difficulty')
                    ->options(Difficulty::class)
                    ->label(__('fields.exercise.difficulty'))
                    ->query(function($query, array $data) {
                        return $query->when(
                            $data['value'],
                            fn($query, $value) => $query->where('difficulty', $value)
                        );
                    }),

                SelectFilter::make('muscleGroup.name')
                    ->options(MuscularGroup::all()->pluck('name'))
                    ->label(__('fields.exercise.muscle_group'))
                    ->query(function($query, array $data) {
                        return $query->when(
                            $data['value'],
                            fn($query, $value) => $query->where('muscleGroupId', $value)
                        );
                    })
            ])
            ->recordActions([

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
