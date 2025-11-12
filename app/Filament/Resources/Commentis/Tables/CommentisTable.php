<?php

namespace App\Filament\Resources\Commentis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('commento'),
                TextColumn::make('commentabile')
                    ->label('Oggetto')
                    ->getStateUsing(function ($record) {
                     $related = $record->commentabile;

                     if (! $related) {
                     return '-';
                      }

                       return match (get_class($related)) {
                         \App\Models\Post::class => $related->title,
                         \App\Models\User::class => $related->name,
                         \App\Models\Category::class => $related->name,
                          default => '—',
                          };
                                   }),
                TextColumn::make('commentabile_type')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
