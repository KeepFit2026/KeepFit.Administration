<?php

namespace App\Filament\Exports;

use App\Models\Exercise;
use App\Traits\HasExport;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class ExerciseExporter extends Exporter
{
    use HasExport;

    protected static ?string $model = Exercise::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label(__('fields.name')),

            ExportColumn::make('description')
                ->label(__('fields.exercise.description')),

            ExportColumn::make('difficulty.name')
                ->label(__('fields.exercise.difficulty')),

            ExportColumn::make('muscleGroup.name')
                ->label(__('fields.exercise.muscle_group')),

            ExportColumn::make('created_at')
                ->label(__('fields.created_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your exercise export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getOwner(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
}
