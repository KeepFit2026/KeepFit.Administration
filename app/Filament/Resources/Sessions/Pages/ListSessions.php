<?php

namespace App\Filament\Resources\Sessions\Pages;

use App\Filament\Resources\Sessions\SessionsResource;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use App\Traits\HasTable;
use Filament\Resources\Pages\ListRecords;

class ListSessions extends ListRecords
{
    use HasCreateHeaderBtn, HasTable, HasRessourceWidget;

    protected static string $resource = SessionsResource::class;
    protected string $view = 'filament.pages.livewire.list-page';

    protected function getButtonName(): string
    {
        return __('fields.sessions.header_btn');
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
