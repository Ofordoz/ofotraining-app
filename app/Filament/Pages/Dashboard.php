<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

     public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ??static::$title ?? __('Grafici');
    }

      public function filtersForm(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Filtri dei grafici')->schema([
                DatePicker::make('Inizio Periodo'),
                DatePicker::make('Fine Periodo'),
            ])->columns(2)->columnSpanFull()
        ]);
    }
}