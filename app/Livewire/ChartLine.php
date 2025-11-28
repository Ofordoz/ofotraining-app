<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ChartLine extends ChartWidget
{
    protected ?string $heading = 'Registrazioni utenti';
    protected int | string | array $columnSpan = 2;
    public ?string $filter = 'month';
    use InteractsWithPageFilters;

    protected function getData(): array
    {
      $inizio = $this -> filters['Inizio Periodo'];
      $fine = $this -> filters['Fine Periodo'];

    switch ($this->filter) {

        case 'today':
            $trend = Trend::model(User::class)
                ->between(
                    start: now()->startOfDay(),
                    end: now()->endOfDay(),
                )
                ->perHour()
                ->count();
            break;

        case 'week':
            $trend = Trend::model(User::class)
                ->between(
                    start: now()->startOfWeek(),
                    end: now()->endOfWeek(),
                )
                ->perDay()
                ->count();
            break;

        case 'month':
            $trend = Trend::model(User::class)
                ->between(
                    start: now()->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perDay()
                ->count();
            break;

        case 'year':
            $trend = Trend::model(User::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count();
            break;
        
        case 'personalizzato':
            default:    
            $trend = Trend::model(User::class)
                ->between(
                    start: $inizio ? Carbon::parse ($inizio)  : now()->startOfYear(),
                    end: $fine ? Carbon::parse ($fine) : now()->endOfYear(),
                )
                ->perDay()
                ->count();
            break;
                }
        return [
        'datasets' => [
            [
                'label' => 'Registrazione utenti',
                'fill' => true,
                'borderColor' => 'rgb(75, 192, 192)',
                'backgroundColor' => 'rgba(133, 133, 133, 0.4)',
                'data' => $trend->map(fn (TrendValue $value) => $value->aggregate),
                'borderWidth' => 1,
                'pointBackgroundColor' => 'rgba(255, 255, 255, 1)',
            ],
        ],
        'labels' => $trend->map(fn (TrendValue $value) => $value->date),
    ];        
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
{
    return [
        'today' => 'Oggi',
        'week' => 'Settimana',
        'month' => 'Mese',
        'year' => 'Anno',
        'personalizzato' => 'Scegli Periodo',
    ];
}
}
