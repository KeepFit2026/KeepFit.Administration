<?php

namespace App\Filament\Resources\Programs\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.programs.name'))
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label(__('fields.programs.isActive')),

                TextColumn::make('sessions_count')
                    ->label(__('fields.programs.sessions_count'))
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('')->tooltip(__('tooltip.edit')),
                DeleteAction::make()->label('')->tooltip(__('tooltip.delete'))
            ])
            ->toolbarActions([
            ]);
    }
}
