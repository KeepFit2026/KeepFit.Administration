<?php

namespace App\Filament\Resources\Programs\Pages;

use App\Filament\Resources\Programs\ProgramResource;
use App\Livewire\CustomStatCard;
use App\Models\Program;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrograms extends ListRecords
{
    protected static string $resource = ProgramResource::class;

    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-s-plus')
                ->label(__('fields.programs.header_action'))
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ])
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            CustomStatCard::make([
                'title' => 'Programmes',
                'value' => Program::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
        ];
    }
}
