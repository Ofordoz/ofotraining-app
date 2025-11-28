<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Livewire\NumeroPost;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
        'Tutti' => Tab::make(),
        'Pubblicati' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('published', true)),
        'Non pubblicati' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('published', false)),
        'Laravel' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('Category_id', 1)),
        'PHP' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('Category_id', 2)),
        'Livewire' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('Category_id', 3)),    
        ];
    }

}
