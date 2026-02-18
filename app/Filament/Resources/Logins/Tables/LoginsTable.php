<?php

namespace App\Filament\Resources\Logins\Tables;

use App\Enum\UserRole;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoginsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('roleId')
                    ->label(__('fields.role'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => UserRole::from((int) $state)->getLabel())
                    ->color(fn ($state) => UserRole::from((int) $state)->getColor())
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ])
            ->toolbarActions([
            ]);
    }
}
