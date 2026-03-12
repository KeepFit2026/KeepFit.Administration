<?php

namespace App\Traits;

use App\Livewire\CustomStatCard;

trait HasRessourceWidget
{
    public function getHeaderWidgets(): array
    {
        $model = $this->getModel();

        return [
            CustomStatCard::make([
                'title'       => class_basename($model),
                'value'       => $model::count(),
                'description' => 'Muscu & cardio',
                'icon'        => $this->getStatIcon(),
                'color'       => $this->getStatColor(),
            ]),
        ];
    }

    abstract protected function getStatIcon(): string;

    abstract protected function getStatColor(): string;
}
