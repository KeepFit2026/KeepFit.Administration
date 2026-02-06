<?php

namespace App\Filament\Resources\Exercises\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExercisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.name')),
                TextColumn::make('description')
                    ->label(__('fields.description'))
            ])
            ->filters([
                //
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
