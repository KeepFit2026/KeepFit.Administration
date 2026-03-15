<?php

namespace App\Filament\Resources\Equipment\Pages;

use App\Filament\Resources\Equipment\EquipmentResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ManageRecords;

class ManageEquipment extends ManageRecords
{
    use HasCreateHeaderBtn, HasTable, HasRessourceWidget;

    protected static string $resource = EquipmentResource::class;
    protected string $view = 'filament.pages.livewire.list-page';

    protected function getButtonName(): string
    {
        return __('fields.equipment.header_btn');
    }

    protected function hasExport(): bool
    {
        return false;
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
