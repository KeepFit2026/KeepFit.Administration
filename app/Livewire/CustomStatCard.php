<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class CustomStatCard extends Widget
{
    protected string $view = 'livewire.custom-stat-card';

    public string $title = '';
    public string $value = '';
    public string $description = '';
    public string $icon = 'bi-activity';
    public string $color = 'emerald';

    protected int|string|array $columnSpan = 1;
}
