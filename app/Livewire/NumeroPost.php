<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NumeroPost extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Numero post totali', Post::count())
                ->icon(Heroicon::ArchiveBox)
                ->color('teal')
                ->description('prova')
                ->descriptionColor('danger')
                ->descriptionIcon(Heroicon::Calculator, IconPosition::After)
                ->chart([100,50,0,100])
                ->chartColor('success')
                ->columnSpan(2),

            Stat::make('Numero utenti totali', User::count()),
        ];

    }
}
