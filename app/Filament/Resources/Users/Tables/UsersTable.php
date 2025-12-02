<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Exports\UserExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->color('giallo')
                    ->label('id utente'),
                TextColumn::make('name')
                    ->color('teal')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->color('teal')
                    ->searchable(),
                TextColumn::make('role')
                    ->formatStateUsing(fn ($state) => strtoupper($state))    
                    ->label('Ruolo')
                    ->badge()    
                    ->color(function(string $state) : string{
                        return match($state) {
                            'ADMIN' => 'danger',
                            'EDITOR' => 'info',
                            'USER' => 'success',
                        };
                    })
                    ->sortable()
                    ->searchable(),                        
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->color('teal')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->color('teal')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->color('teal')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
            ])
            ->headerActions([
                ExportAction::make()
                ->exporter(UserExporter::class)
                ->formats([
                    ExportFormat::Csv]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                ->exporter(UserExporter::class)
                ->formats([
                    ExportFormat::Csv]),
                ]);
            
    }
}
