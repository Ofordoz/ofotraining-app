<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserResource extends StatsOverviewWidget
{
   

public ?User $record; 

    public function mount($record = null)
    {
        $this->record = $record;
    }

protected function getStats(): array
    {
        return [
            Stat::make('Utenti', $this->record->name ),
        ];
    }
}
