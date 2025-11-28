<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentisRelationManager extends RelationManager
{
    protected static string $relationship = 'commentis';
   
    public function form(Schema $schema): Schema
    {
         return $schema
            ->components([
                Select::make('users_id')
                    ->label('Utente')
                    ->relationship('user', 'name')
                    ->default(fn ($livewire) => $livewire->getOwnerRecord()->id)
                    ->disabled(),

                // Hidden::make('user_id')
                //     ->default(fn ($livewire) => $livewire->getOwnerRecord()->id)
                //     ->required(),

                TextInput::make('commento'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Commento')
            ->columns([
                TextColumn::make('user.name')
                   ->label('Utente'),
                TextColumn::make('commento'),
  
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //CreateAction::make(),
                //AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                //DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
