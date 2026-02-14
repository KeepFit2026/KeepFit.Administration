<?php
namespace App\Filament\Resources\MuscleGroups\Pages;

use App\Filament\Resources\MuscleGroups\MuscleGroupResource;
use App\Livewire\CustomStatCard;
use App\Models\MuscularGroup;
use App\Services\MuscleGroupService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageMuscleGroups extends ManageRecords
{
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
                ->using(function(array $data, string $model): Model {
                    $apiService = app(MuscleGroupService::class);
                    $createData = $apiService->CreateAsync($data);
                    MuscularGroup::clearCache(); // Vider le cache Sushi
                    return $model::make($createData);
                })
                ->after(function () {
                    $this->resetTable(); // Forcer Livewire à recharger les données
                    $this->dispatch('muscleGroupCreated');
                }),
        ];
    }

    // Écouter l'événement et rafraîchir
    protected $listeners = ['muscleGroupCreated' => '$refresh'];

    public function getHeaderWidgets(): array
    {
        return [
            CustomStatCard::make([
                'title' => 'Groupes',
                'value' => MuscularGroup::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
        ];
    }
}