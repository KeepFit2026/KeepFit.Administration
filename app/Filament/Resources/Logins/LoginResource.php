<?php

namespace App\Filament\Resources\Logins;

use App\Filament\Resources\Logins\Pages\ManageLogins;
use App\Filament\Resources\Logins\Schemas\LoginForm;
use App\Filament\Resources\Logins\Tables\LoginsTable;
use App\Models\Login as ModelsLogin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LoginResource extends Resource
{
    protected static ?string $model = ModelsLogin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'email';

    protected static ?string $navigationLabel = 'Comptes utilisateur';
    protected static ?string $pluralLabel = 'Comptes utilisateur';

    protected static string|UnitEnum|null $navigationGroup = "Académie";

    public static function form(Schema $schema): Schema
    {
        return LoginForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoginsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLogins::route('/'),
        ];
    }
}
