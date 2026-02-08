<?php 

namespace App\Livewire;

use App\Contracts\AuthServiceInterface;
use Livewire\Component;

class SidebarFooter extends Component
{
    public function logout()
    {
        redirect()->route('login.logout');
    }

    public function render()
    {
        return view('filament.livewire.logout-btn');
    }
}