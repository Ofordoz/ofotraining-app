<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ChartLine extends ChartWidget
{
    protected ?string $heading = 'Chart Line';
    protected int | string | array $columnSpan = 2;
    public ?string $filter = 'month';

    protected function getData(): array
    {
      $query = User::query();

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
        default:
            $trend = Trend::model(User::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count();
            break;
                }
        return [
        'datasets' => [
            [
                'label' => 'Registrazione utenti',
                'data' => $trend->map(fn (TrendValue $value) => $value->aggregate),
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
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
}
}
