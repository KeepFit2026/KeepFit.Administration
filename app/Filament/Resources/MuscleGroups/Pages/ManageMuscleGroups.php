<?php
namespace App\Filament\Resources\MuscleGroups\Pages;

use App\Filament\Resources\MuscleGroups\MuscleGroupResource;
use App\Filament\Resources\MuscleGroups\Tables\MuscleGroupsTable;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Table;

class ManageMuscleGroups extends ManageRecords
{
    use HasRessourceWidget, HasCreateHeaderBtn;

    protected static string $resource = MuscleGroupResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('fields.muscular_group.header_btn'))
                ->icon('heroicon-s-plus')
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ])
                ->after(function () {
                    $this->resetTable();
                    $this->dispatch('muscleGroupCreated');
                }),
        ];
    }

    public function table(Table $table): Table
    {
        return MuscleGroupsTable::configure($table);
    }

    // Écouter l'événement et rafraîchir
    protected $listeners = ['muscleGroupCreated' => '$refresh'];

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
        return __('fields.exercise.header_btn');
    }
}