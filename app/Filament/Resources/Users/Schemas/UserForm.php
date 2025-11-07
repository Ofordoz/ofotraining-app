<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nome')
                    ->suffixIcon(Heroicon::Users),
                TextInput::make('email')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                   // ->visibleOn('create')
                    ->required((fn (string $context) => $context === 'create'))
                    ->placeholder(fn (string $context) => $context === 'edit' ? 'Lascia vuoto per non modificare la passowrd' : null),
            ]);
    }
}
