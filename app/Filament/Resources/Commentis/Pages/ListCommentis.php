<?php

namespace App\Filament\Resources\Commentis\Pages;

use App\Filament\Resources\Commentis\CommentiResource;
use App\Models\Commenti;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCommentis extends ListRecords
{
    protected static string $resource = CommentiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Tutti' => Tab::make()
                ->icon('heroicon-m-user-group')
                ->badge(Commenti::count())
                ->badgeColor('gray'),
            User::find(1)->name => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', 1))
                ->badge(Commenti::whereHas('user', fn ($q) => $q->where('user_id', 1))->count())
                ->badgeColor('gray'),
            User::find(7)->name => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', 7))
                ->badge(Commenti::whereHas('user', fn ($q) => $q->where('user_id', 7))->count())
                ->badgeColor('gray'),
            User::find(2)->name => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', 2))
                ->badge(Commenti::whereHas('user', fn ($q) => $q->where('user_id', 2))->count())
                ->badgeColor('gray'),
        ];    
    }    
    
}
