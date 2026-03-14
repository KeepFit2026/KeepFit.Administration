<?php

namespace App\Filament\Resources\Exports\Pages;

use App\Filament\Resources\Exports\ExportResource;
use App\Traits\HasRessourceWidget;
use Filament\Resources\Pages\ManageRecords;

class ManageExports extends ManageRecords
{
    use HasRessourceWidget;
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
}
