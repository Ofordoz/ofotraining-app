<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use function Pest\Laravel\post;

class Usersz extends StatsOverviewWidget
{

    public ?User $record; 

    protected function getStats(): array
    {
        return [
            Stat::make('Nome utente:', $this->record->name),
            Stat::make('Numero post:', $this->record->posts()->count()),
            Stat::make('Numero commenti:', $this->record->commentis()->count()),
        ];
    }
}
