<?php

namespace App\Filament\Resources\Classrooms\Pages;

use App\Filament\Resources\Classrooms\ClassroomResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ManageRecords;

class ManageClassrooms extends ManageRecords
{
    use HasCreateHeaderBtn, HasRessourceWidget, HasTable;

    protected static string $resource = ClassroomResource::class;

    protected string $view = 'filament.pages.livewire.list-page';

    protected function getButtonName(): string
    {
        return __('fields.classrooms.header_action');
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
