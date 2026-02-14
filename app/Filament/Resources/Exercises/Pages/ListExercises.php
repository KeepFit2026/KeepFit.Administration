<?php
namespace App\Filament\Resources\Exercises\Pages;

use App\Filament\Resources\Exercises\ExerciseResource;
use App\Filament\Resources\Exercises\Tables\ExercisesTable;
use App\Livewire\CustomStatCard;
use App\Models\Exercise;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class ListExercises extends ListRecords
{
    protected static string $resource = ExerciseResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-s-plus')
                ->label(__('fields.exercise.header_btn'))
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ]),
        ];
    }

    public function table(Table $table): Table
    {
        return ExercisesTable::configure($table);
    }

    public function getHeaderWidgets(): array
    {
        return [
            CustomStatCard::make([
                'title' => 'Exercices',
                'value' => Exercise::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
            CustomStatCard::make([
                'title' => 'Exercices',
                'value' => Exercise::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
        ];
    }
}