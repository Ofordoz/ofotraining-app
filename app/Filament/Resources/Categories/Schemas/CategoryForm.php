<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Livewire\Form as LivewireForm;
use Termwind\Components\Dd;

use function Livewire\str;
use function Symfony\Component\Translation\t;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->afterStateUpdated(function (string $operation, string $state, Set $set) {
                                          $set('slug',Str::slug($state));
                                        })
                    ->live(onBlur:true)
                    ->unique(),
                TextInput::make('slug')
                    ->unique(),
            ]);
    }
}
