<?php

namespace App\Filament\Resources\Logins\Pages;

use App\Filament\Exports\LoginExporter;
use App\Filament\Resources\Logins\LoginResource;
use App\Filament\Resources\Logins\Tables\LoginsTable;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ManageLogins extends ManageRecords
{
    use HasCreateHeaderBtn, HasRessourceWidget, HasTable;

    protected static string $resource = LoginResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    public function table(Table $table): Table
    {
        return LoginsTable::configure($table)
             ->headerActions([
                ...$this->getTableExtraActions(),
                ExportAction::make()
                    ->exporter(LoginExporter::class)
        ]);
    }

    protected function getButtonName(): string
    {
        return __('fields.login.header_action');
    }

    protected function afterCreateHook(Model $record, array $data): void
    {
        if(isset($data['roles']) && !empty($data['roles'])) {
            $record->assignRole($data['roles']);
        }

        if(isset($data['user'])) {
            $record->user()->create([
                'name' => $data['user'],
            ]);
        }
    }

    protected function getStatIcon(): string
    {
        return 'bi-lightnig-charge';
    }

    protected function getStatColor(): string
    {
        return 'emerald';
    }


    protected function getImportedBtn(): bool
    {
        return true;
    }
}
