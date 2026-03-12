<?php

namespace App\Filament\Resources\Programs\Pages;

use App\Filament\Resources\Programs\ProgramResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasToggle;
use Filament\Resources\Pages\ListRecords;

class ListPrograms extends ListRecords
{
    use HasToggle, HasRessourceWidget, HasCreateHeaderBtn;

    protected static string $resource = ProgramResource::class;

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
        return __('fields.programs.header_action');
    }
}
