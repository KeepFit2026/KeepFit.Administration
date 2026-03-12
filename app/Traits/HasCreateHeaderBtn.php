<?php

namespace App\Traits;

use App\Models\Login;
use Filament\Actions\CreateAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Str;

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
                ->mutateFormDataUsing(function(array $data): array {
                    if($this->getModel() === Login::class) {
                        $data = $this->generatePassword($data);
                    }
                    return $data;
                })
                ->after(fn(Model $record, array $data)
                    => $this->afterCreateHook($record, $data)
                )
                ->label($this->getButtonName()),
        ];
    }

    abstract protected function getButtonName(): string;

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
