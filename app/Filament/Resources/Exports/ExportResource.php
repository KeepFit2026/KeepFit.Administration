<?php

namespace App\Filament\Resources\Exports;

use App\Filament\Exports\ExerciseExporter;
use App\Filament\Resources\Exports\Pages\ManageExports;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class ExportResource extends Resource
{
    protected static ?string $model = Export::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowDownTray;

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $recordTitleAttribute = 'file_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('file_name')
                    ->label(__('fields.export.name'))
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_name')
            ->columns([
                TextColumn::make('file_name')
                    ->label(__('fields.export.name'))
                    ->searchable(),

                TextColumn::make('resource')
                    ->label(__('fields.export.resource.name'))
                    ->formatStateUsing(fn($state)
                        => match($state) {
                            ExerciseExporter::class => __('fields.export.resource.exercises'),
                            default =>  __('fields.export.resource.exercises'),
                        })
                    ->badge()
                    ->color('info')
            ])
            ->filters([
                SelectFilter::make(__('filters.resource'))
                    ->options([
                        ExerciseExporter::class => 'Exercice',
                        // Autre plus tard
                        ])
                    ->query(fn($query, $data) => $data['value']
                        ? $query->where('exporter', $data['value'])
                        : $query
                        )
            ])
            ->recordActions([
                static::downloadAction(),
                EditAction::make('edit')
                    ->label('')
                    ->tooltip(__('tooltip.edit')),

                DeleteAction::make('delete')
                    ->label('')
                    ->before(fn(Export $record) => static::beforeDelete($record))
                    ->tooltip(__('tooltip.delete')),
            ])
            ->toolbarActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageExports::route('/'),
        ];
    }

    protected static function downloadAction(): Action
    {
        return Action::make('download')
            ->color('warning')
            ->action(fn(Export $record) => static::dowloadExport($record))
            ->tooltip(__('tooltip.download'));
    }

    protected static function dowloadExport(Export $record)
    {
        $disk = $record->disk ?? 'public';
        $directory = 'filament_exports/' . $record->getKey(); // Récup de l'id de l'export.

        $files = Storage::disk($disk)->files($directory);

        if(empty($files)) {
            Notification::make()
                ->danger()
                ->title('Fichier introuvable')
                ->send();
                return;
        }

        $file = collect($files)->first(fn($f) => str_ends_with($f, '.xlsx'));
        $fileName = $record->file_name ?? basename($file);

        /** @phpstan-ignore-next-line */
        return Storage::disk($disk)->download($file, $fileName);
    }

    protected static function beforeDelete(Export $record): void
    {
        $disk = $record->disk ?? 'public';
        $directory = 'filament_exports/' . $record->getKey();

        /** @phpstan-ignore-next-line */
        if(Storage::disk($disk)->directoryExists($directory)) {
            Storage::disk($disk)->deleteDirectory($directory);
        }
    }
}
