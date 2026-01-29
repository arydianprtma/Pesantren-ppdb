<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RealtimeClockWidget extends Widget
{
    protected static ?int $sort = 1; // Tampilkan paling atas

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.realtime-clock-widget';
}
