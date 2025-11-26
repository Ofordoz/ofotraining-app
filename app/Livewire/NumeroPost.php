<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NumeroPost extends StatsOverviewWidget

{
    protected int | string | array $columnSpan = 1;
    use InteractsWithPageFilters;
 
    protected function getStats(): array
    
    
    {
        $inizio = $this -> filters['Inizio Periodo'];
        $fine = $this -> filters['Fine Periodo'];
        
        return [
           
            Stat::make('Post totali', 
                Post::when($inizio, fn ($query) => $query->whereDate('created_at', '>', $inizio))
                ->when ($fine, fn ($query) => $query->whereDate('created_at', '<', $fine))
                ->count())
                ->icon(Heroicon::ArchiveBox)
                ->color('teal')
              //  ->description('prova')
              //  ->descriptionColor('danger')
                ->descriptionIcon(Heroicon::Calculator, IconPosition::After)
                ->chart([100,50,0,100])
                ->chartColor('success'),
            
            Stat::make('Utenti totali', 
                User::when ($inizio, fn ($query) => $query->whereDate('created_at', '>', $inizio))
                ->when ($fine, fn ($query) => $query->whereDate('created_at', '<', $fine))
                ->count())
                
                ->icon(Heroicon::Users)
                ->color('teal')
                ->descriptionIcon(Heroicon::Calculator, IconPosition::After)
                ->chart([100,0,100,0,100,0,100,0,100]),
  
                
        ];
    }
}
