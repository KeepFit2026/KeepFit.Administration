<?php

namespace App\Filament\Resources\Classrooms\Pages;

use App\Filament\Resources\Classrooms\ClassroomResource;
use App\Livewire\CustomStatCard;
use App\Models\Classroom;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClassrooms extends ManageRecords
{
    protected static string $resource = ClassroomResource::class;

    protected string $view = 'filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-s-plus')
                ->label(__('fields.classrooms.header_action'))
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ]),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            CustomStatCard::make([
                'title' => 'Classes',
                'value' => Classroom::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
        ];
    }
}
