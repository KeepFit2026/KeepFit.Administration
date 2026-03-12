<?php

namespace App\Filament\Resources\Logins\Schemas;

use App\Enum\UserRole;
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
                Select::make('roleId')
                    ->label(__('fields.role'))
                    ->required()
                    ->options(UserRole::class)
            ]);
    }
}
