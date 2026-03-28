<?php

namespace App\Filament\Resources\Sessions\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable(),

                TextColumn::make('description')
                    ->label(__('fields.description'))
                    ->searchable(),

                TextColumn::make('difficulty.name')
                    ->label(__('fields.sessions.difficulty'))
                    ->badge()
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
