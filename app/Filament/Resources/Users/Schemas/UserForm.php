<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
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
                    ->required(fn (string $operation) => $operation == 'create')
                    ->label('Nome')
                    ->suffixIcon(Heroicon::Users),
                TextInput::make('email')
                    ->email()
                    ->required(fn (string $operation) => $operation == 'create'),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                   // ->visibleOn('create')
                    ->required((fn (string $operation) => $operation === 'create'))
                    ->placeholder((fn (string $operation) => $operation === 'edit' ? 'Lascia vuoto per non modificare la password' : null))
                    ->dehydrated(fn ($state) => filled($state)),
                Select::make('role')
                    ->options(User::ROLES)
                    ->required((fn (string $operation) => $operation === 'create'))
            ]);
    }
}
