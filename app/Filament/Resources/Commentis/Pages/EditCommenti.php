<?php

namespace App\Filament\Resources\Commentis\Pages;

use App\Filament\Resources\Commentis\CommentiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCommenti extends EditRecord
{
    protected static string $resource = CommentiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
