<?php

namespace App\Traits;

trait HasTable
{
    /**
     * Définit si le tableau à la possiblité d'exporter les données.
     * @return boolean
     */
    protected function hasExport(): bool
    {
        return true;
    }

    /**
     * Méthode custom pour 'toggle' le status du programme (actif/inactif)
     * @param string $uuid Id du programme
     * @param string $column Colonne à modiff
    */
    public function toggleColumnState(string $column, string $uuid): void
    {
        $model = $this->getModel();
        $record = $model::find($uuid);

        if($record){
            $record->update([$column => !$record->{$column}]); // On inverse
            $this->resetTable(); // On force le re-rendu du tableau.
        }
    }
}
