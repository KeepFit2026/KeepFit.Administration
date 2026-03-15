<?php

namespace App\Filament\Resources\Logins\Tables;

use App\Filament\Resources\Logins\LoginResource;
use Filament\Actions\Action;
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
                    ->label(__('fields.email'))
                    ->searchable(),

                    TextColumn::make('roles.name')
                        ->searchable()
                        ->label(__('fields.role'))
                        ->formatStateUsing(function ($record) {
                            return $record->roles->map(function ($role) {
                                $name = ucfirst(strtolower($role->name));
                                $color = match (strtolower($role->name)) {
                                    'admin'  => '#ef4444',
                                    'teacher' => '#f59e0b',
                                    'user'   => '#10b981',
                                    default  => '#6b7280',
                                };
                                return "<span style='background-color:{$color}20; color:{$color}; padding:2px 8px; border-radius:6px; font-size:11px; font-weight:700; text-transform:uppercase;'>{$name}</span>";
                            })->implode(' ');
                        })
                        ->html(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                self::viewAction(),
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ])
            ->toolbarActions([
            ]);
    }

    protected static function viewAction(): Action
    {
        return Action::make('view')
            ->tooltip(__('tooltip.view'))
            ->url(fn($record) => LoginResource::getUrl('view', ['record' => $record]));
    }
}
