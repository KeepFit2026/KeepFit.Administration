<?php

namespace App\Filament\Resources\MuscleGroups;

use App\Filament\Resources\MuscleGroups\Pages\ManageMuscleGroups;
use App\Filament\Resources\MuscleGroups\Schemas\MuscleGroupForm;
use App\Filament\Resources\MuscleGroups\Tables\MuscleGroupsTable;
use App\Models\MuscularGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MuscleGroupResource extends Resource
{
    protected static ?string $model = MuscularGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;

    protected static ?string $navigationLabel = 'Groupes musculaires';

    protected static ?string $pluralLabel = 'Groupes musculaires';

    protected static string|UnitEnum|null $navigationGroup = 'Entrainement';

    protected static ?string $recordTitleAttribute = 'Name';

    public static function form(Schema $schema): Schema
    {
        return MuscleGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MuscleGroupsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMuscleGroups::route('/'),
        ];
    }
}
