<?php

namespace App\Filament\Resources\Difficulties\Pages;

use App\Filament\Resources\Difficulties\DifficultiesResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ManageRecords;

class ManageDifficulties extends ManageRecords
{
    use HasRessourceWidget, HasCreateHeaderBtn, HasTable;

    protected static string $resource = DifficultiesResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getStatIcon(): string
    {
        return 'bi-lightnig-charge';
    }

    protected function getStatColor(): string
    {
        return 'emerald';
    }

    protected function getButtonName(): string
    {
        return __('fields.difficulty.header_action');
    }
}
