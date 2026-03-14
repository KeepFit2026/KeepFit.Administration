<?php

namespace App\Filament\Resources\Logins\Pages;

use App\Filament\Resources\Logins\LoginResource;
use App\Filament\Resources\Logins\Tables\LoginsTable;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
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
        return LoginsTable::configure($table);
    }

    protected function getButtonName(): string
    {
        return __('fields.login.header_action');
    }

    protected function getStatIcon(): string
    {
        return 'bi-lightnig-charge';
    }

    protected function getStatColor(): string
    {
        return 'emerald';
    }

    protected function afterCreateHook(Model $record, array $data): void
    {
        if(isset($data['roles']) && !empty($data['roles'])) {
            $record->assignRole($data['roles']);
        }
    }
}
