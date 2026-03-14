<?php

namespace App\Filament\Resources\Exports\Pages;

use App\Filament\Resources\Exports\ExportResource;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ManageRecords;

class ManageExports extends ManageRecords
{
    use HasRessourceWidget, HasTable;
    protected static string $resource = ExportResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    protected function getStatIcon(): string
    {
        return 'bi-lightnig-charge';
    }

    protected function getStatColor(): string
    {
        return 'emerald';
    }

    //Overide du trait HasTable
    protected function hasExport(): bool
    {
        return false;
    }
}
