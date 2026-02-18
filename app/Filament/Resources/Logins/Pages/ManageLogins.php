<?php

namespace App\Filament\Resources\Logins\Pages;

use App\Filament\Resources\Logins\LoginResource;
use App\Filament\Resources\Logins\Tables\LoginsTable;
use App\Livewire\CustomStatCard;
use App\Models\Login;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Str;

class ManageLogins extends ManageRecords
{
    protected static string $resource = LoginResource::class;
    protected string $view = 'Filament.pages.livewire.list-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('fields.login.header_action'))
                ->icon('heroicon-s-plus')
                ->mutateDataUsing(function(array $data) {
                    $data['password'] = Hash::make(Str::random(20));
                    return $data;
                })
                ->extraAttributes([
                    'class' => 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white border-none shadow-md font-bold tracking-wide',
                ]),
        ];
    }

    public function table(Table $table): Table
    {
        return LoginsTable::configure($table);
    }

    public function getHeaderWidgets(): array
    {
        return [
            CustomStatCard::make([
                'title'       => 'Comptes utilisateur',
                'value'       => Login::count(),
                'description' => 'Muscu & cardio',
                'icon'        => 'bi-lightning-charge',
                'color'       => 'emerald',
            ]),
        ];
    }
}
