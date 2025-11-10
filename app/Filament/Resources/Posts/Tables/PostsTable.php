<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                TextColumn::make('autori.name')
                    ->searchable()
                    ->toggleable(),
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
               // Filter::make('Post pubblicati')
            //    ->query(fn (Builder $query): Builder =>$query->where('published', true)),
                TernaryFilter::make('published')
                    ->label('Post pubblicati'),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
