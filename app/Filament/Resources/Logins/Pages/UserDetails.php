<?php

namespace App\Filament\Resources\Logins\Pages;

use App\Filament\Resources\Logins\LoginResource;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Log;

class UserDetails extends ViewRecord
{
    protected static string $resource = LoginResource::class;
    protected string $view = 'filament.pages.user-details';

    public function getViewData(): array
    {
        return [
            'user' => User::where('account_id', $this->record->id)->first()
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pdf')
                ->label('Fiche PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->openUrlInNewTab()
                ->url(fn() => '/api/admin/pdf/' . $this->record->id),
        ];
    }

    public function generateUserPdf()
    {
        Log::info('oui');
        $user = User::where('account_id', $this->record->id)->first();
        $pdf = Pdf::loadView('filament.pages.user-pdf', [
            'record' => $this->record,
            'user'   => $user
        ]);

        return $pdf->download(($user->profile->name) ?? 'utilisateur' . 'fiche.pdf');
    }
}
