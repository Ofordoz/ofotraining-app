<?php

namespace App\Filament\Resources\Posts\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AutoriRelationManager extends RelationManager
{
    protected static string $relationship = 'autori';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->readOnly(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->readOnly(),
                DateTimePicker::make('email_verified_at')
                    ->readOnly(),
                TextInput::make('order')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('order')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //CreateAction::make(),
                AttachAction::make()
                    ->schema(fn (AttachAction $action): array => [
                       $action->getRecordSelect(),
                       TextInput::make('order')->required(),
                    ])
                       ])
            ->recordActions([
                EditAction::make()
                ->modalHeading('Modifica Order')
                ->schema([
                    Section::make()
                      ->schema ([
                      TextInput::make('name')
                        ->readOnly(),
                      TextInput::make('email')
                        ->label('Email address')
                        ->readOnly(),
                      TextInput::make('order')
                        ->numeric()
                        ->required()
                        ->columnSpanFull(),
                    ])->columns(2),    
                ]),
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
