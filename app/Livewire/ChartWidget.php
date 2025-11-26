<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget as BaseChartWidget;

class ChartWidget extends BaseChartWidget
{
    protected ?string $heading = 'Ciambella di prova';
    
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [10, 100, 50],
                    'fill' => true,
            'backgroundColor' => [
                          'rgb(255, 99, 132)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 205, 86)'
            ],                    
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
