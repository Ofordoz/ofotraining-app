<?php

namespace App\Filament\Resources\Commentis\Pages;

use App\Filament\Resources\Commentis\CommentiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCommentis extends ListRecords
{
    protected static string $resource = CommentiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
