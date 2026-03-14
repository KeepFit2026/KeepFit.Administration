<?php
namespace App\Filament\Resources\Exercises\Pages;

use App\Filament\Resources\Exercises\ExerciseResource;
use App\Filament\Resources\Exercises\Tables\ExercisesTable;
use App\Traits\HasCreateHeaderBtn;
use App\Traits\HasRessourceWidget;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListExercises extends ListRecords
{
    use HasRessourceWidget, HasCreateHeaderBtn;

    protected static string $resource = ExerciseResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    public function table(Table $table): Table
    {
        return ExercisesTable::configure($table)
            ->headerActions($this->getTableExtraActions());
    }

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

    protected function getImportedBtn(): bool
    {
        return true;
    }
}