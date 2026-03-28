<?php

namespace App\Filament\Resources\Sessions;

use App\Filament\Resources\Sessions\Pages\CreateSessions;
use App\Filament\Resources\Sessions\Pages\EditSessions;
use App\Filament\Resources\Sessions\Pages\ListSessions;
use App\Filament\Resources\Sessions\Schemas\SessionsForm;
use App\Filament\Resources\Sessions\Tables\SessionsTable;
use App\Models\Session;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SessionsResource extends Resource
{
    protected static ?string $model = Session::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Séances';

    protected static ?string $pluralLabel = 'Les Séances';

    protected static string|UnitEnum|null $navigationGroup = 'Entrainement';

    public static function form(Schema $schema): Schema
    {
        return SessionsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSessions::route('/'),
            'create' => CreateSessions::route('/create'),
            'edit' => EditSessions::route('/{record}/edit'),
        ];
    }
}
