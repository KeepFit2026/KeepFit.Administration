<?php

namespace App\Filament\Imports;

use App\Models\Exercise;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ExerciseImporter extends Importer
{
    protected static ?string $model = Exercise::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label(__('fields.name'))
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),

            ImportColumn::make('description')
                ->label(__('fields.exercise.description'))
                ->rules(['nullable', 'string']),

            ImportColumn::make('difficulty_id')
                ->label(__('fields.exercise.difficulty'))
                ->numeric()
        ];
    }

    public function resolveRecord(): Exercise
    {
        return Exercise::firstOrNew([
            'name' => $this->data['name'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your exercise import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
