<?php

namespace App\Filament\Imports;

use App\Events\ImportCompleted;
use App\Models\Login;
use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Number;
use Str;

class LoginImporter extends Importer
{
    protected static ?string $model = Login::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('email')
                ->label(__('fields.email'))
                ->requiredMapping()
                ->rules(['required', 'email']),

            ImportColumn::make('username')
                ->fillRecordUsing(function() {})
                ->label(__('fields.profile.name')),

            ImportColumn::make('role')
                ->fillRecordUsing(function() {})
                ->guess(['Role', 'role', 'Rôle', 'rôle'])
                ->label(__('fields.role')),
        ];
    }

    public function afterSave(): void
    {
        User::on('pgsql_second')->updateOrCreate(
            ['account_id' => $this->record->id],
            ['name' => $this->data['username']]
        );

        $allowed_roles = ['user', 'teacher'];
        $role = in_array($this->data['role'] ?? null, $allowed_roles)
            ? $this->data['role']
            : 'user';

        $this->record->syncRoles([$role]);
    }

    public function resolveRecord(): Login
    {
        $login = Login::on('pgsql')
            ->where('email', $this->data['email'])
            ->first();

        if (!$login) {
            $login = new Login();
            $login->email = $this->data['email'];
            $login->password = Hash::make(Str::random(8));
        }

        return $login;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your login import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
