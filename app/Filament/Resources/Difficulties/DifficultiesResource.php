<?php

namespace App\Filament\Resources\Difficulties;

use App\Filament\Resources\Difficulties\Pages\ManageDifficulties;
use App\Models\Difficulty;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class DifficultiesResource extends Resource
{
    protected static ?string $model = Difficulty::class;

    protected static ?string $navigationLabel = 'Difficultés';

    protected static ?string $pluralLabel = 'Les Difficultés';

    protected static string|UnitEnum|null $navigationGroup = 'Entrainement';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('fields.name'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('')->tooltip(__('tooltip.edit')),
                DeleteAction::make()->label('')->tooltip(__('tooltip.delete')),
            ])
            ->toolbarActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageDifficulties::route('/'),
        ];
    }
}
