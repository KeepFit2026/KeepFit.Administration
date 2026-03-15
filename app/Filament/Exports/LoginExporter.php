<?php

namespace App\Filament\Exports;

use App\Models\Login;
use App\Models\User;
use App\Traits\HasExport;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class LoginExporter extends Exporter
{
    use HasExport;

    protected static ?string $model = Login::class;

    public static function getEloquentQuery(): Builder
    {
        return Login::on('pgsql')->query();
    }

    public static function getColumns(): array
    {
        $users = User::on('pgsql_second')
            ->pluck('name', 'account_id');

        return [
            ExportColumn::make('email')
                ->label(__('fields.email')),
                
            ExportColumn::make('username')
                ->label(__('fields.profile.name'))
                ->getStateUsing(fn (Login $record): ?string => $users[$record->id] ?? null),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your login export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
