<?php

namespace App\Traits;

use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\TextInput;

trait HasExport
{
      public static function getOptionsFormComponents(): array
    {
        return [
            TextInput::make('fileName')
                ->label('Nom du fichier')
                ->required(),
        ];
    }

    public function getFileName(Export $export): string
    {
        return $this->options['fileName'] ?? $this->getModel() . '-' . now()->format('Y-m-d');
    }

    public static function getPolymorphicPrefix(): string
    {
        return 'export';
    }

    public function getFileDisk(): string
    {
        return 'public';
    }
}
