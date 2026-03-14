<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RolesResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ManageRecords;

class ManageRoles extends ManageRecords
{
    use HasCreateHeaderBtn, HasRessourceWidget, HasTable;
    protected static string $resource = RolesResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getButtonName(): string
    {
        return __('fields.roles.header_action');
    }

    protected function getStatIcon(): string
    {
        return 'bi-lightnig-charge';
    }

    protected function getStatColor(): string
    {
        return 'emerald';
    }
}
