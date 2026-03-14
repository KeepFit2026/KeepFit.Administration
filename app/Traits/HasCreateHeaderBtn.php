<?php

namespace App\Traits;

use App\Models\Login;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Str;

trait HasCreateHeaderBtn
{
    protected function getHeaderActions(): array
    {
        $actions = [];

        //Bouton d'import
        if ($this->getImportedBtn()) {
            $modelName = class_basename(static::getModel());
            $importerClass = "App\\Filament\\Imports\\{$modelName}Importer";

            $actions[] = ImportAction::make()
                ->importer($importerClass)
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->label('Importer');
        }

        //Bouton de création classique
        $actions[] = CreateAction::make()
            ->icon('heroicon-s-plus')
            ->extraAttributes([
                'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
            ])
            ->mutateFormDataUsing(function(array $data): array {
                if (static::getModel() === Login::class) {
                    $data = $this->generatePassword($data);
                }
                return $data;
            })
            ->after(fn(Model $record, array $data)
                => $this->afterCreateHook($record, $data)
            )
            ->label($this->getButtonName());

        return $actions;
    }

    /**
     * Actions pour le Header du Tableau (Import / Export)
     * À appeler dans ton fichier Table
     */
    public function getTableExtraActions(): array
    {
        $actions = [];
        $modelName = class_basename(static::getModel());

        // Bouton d'export (Toujours présent si tu le souhaites)
        $actions[] = ExportAction::make('export') // L'ID doit être 'export' pour ton Blade
            ->exporter("App\\Filament\\Exports\\{$modelName}Exporter")
            ->label('Exporter');

        // Bouton d'import (Optionnel via ton booléen)
        if ($this->getImportedBtn()) {
            $actions[] = ImportAction::make('import') // L'ID doit être 'import'
                ->importer("App\\Filament\\Imports\\{$modelName}Importer")
                ->label('Importer');
        }

        return $actions;
    }

    abstract protected function getButtonName(): string;

    protected function getImportedBtn(): bool
    {
        return false;
    }

    /**
     * Créer un mot de passe aléatoire
     * @return string Le mot de passe
     */
    private function generatePassword(array $data, ?int $lenght = 8): array
    {
        $data['password'] = Hash::make(Str::random($lenght));
        return $data;
    }

    /**
     * Méthode à overide quand l'on doit l'utiler
    */
    protected function afterCreateHook(Model $record, array $data): void {}
}
