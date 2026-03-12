<?php

namespace App\Traits;

use Filament\Actions\CreateAction;

trait HasCreateHeaderBtn
{
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-s-plus')
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ])
                ->label($this->getButtonName()),
        ];
    }

    abstract protected function getButtonName(): string;
}
