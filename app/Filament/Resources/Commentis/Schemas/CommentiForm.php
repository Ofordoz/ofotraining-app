<?php

namespace App\Filament\Resources\Commentis\Schemas;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommentiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Utente')
                  // ->visible(fn ($operation) => $operation === 'create')
                    ->disabled(function ($operation) {
                        if ($operation === 'edit') return true;
                    })
                    ->relationship('user','name'),
                TextInput::make('commento'),
                MorphToSelect::make('commentabile')
                    ->types([
                        Type::make(Post::class)->titleAttribute('title'),
                        Type::make(User::class)->titleAttribute('name'),
                        Type::make(Category::class)->titleAttribute('name')
                    ])
                    ->disabled(function ($operation) {
                        if ($operation === 'edit') return true;
                    }),
            ]);
    }
}
