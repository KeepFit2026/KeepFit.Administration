<?php

namespace App\Filament\Resources\Logins\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LoginForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->required()
                    ->email(true)
                    ->maxLength(255),
                Select::make('roles')
                    ->label(__('fields.role'))
                    ->relationship('roles', 'name')
                    ->required()
            ]);
    }
}
