<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('thumbnail'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('color')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('tags'),
                Toggle::make('published')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Posts')
            ->columns([
                TextColumn::make('category_id')
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->color('teal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('color'),
                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),
                TextColumn::make('tags')
                    ->searchable()
                    ->sortable()    
                    ->toggleable()
                    ->badge(),
                CheckboxColumn::make('published')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Publicato il')    
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //CreateAction::make(),
                AttachAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
                //DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    //DeleteBulkAction::make(),
                ]),
            ]);
    }
}
