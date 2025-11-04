<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostRelationManager extends RelationManager
{
    protected static string $relationship = 'Post';

    public function form(Schema $schema): Schema
    {
        return $schema
                ->components([

               Section::make('sono un header')
                  ->description('Funziona! gloria a voi (sono una descrizione)')
                  ->icon(Heroicon::Trophy)
                  ->schema([ 

                TextInput::make('title')
                    ->minLength(2)
                    ->maxLength(10)
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                ColorPicker::make('color')
                    ->required(),  
                MarkdownEditor::make('content')
                    ->required()
                    ->columnSpan(2),   

                  ])->columnSpan(2),     
               
              Group::make()->schema([

               Section::make('Immagine')
                  ->schema([

                FileUpload::make('thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('thumbnail')
                    ->visibility('public'),     
                  ]),
                
               Section::make('Meta')
                   ->collapsible()
                   ->schema([

                TagsInput::make('tags')
                    ->required(),
                Checkbox::make('published'),
                  ])
              ]) 

            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),    
                TextColumn::make('tags')
                    ->searchable(),    
                IconColumn::make('published')  
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckBadge)
                    ->falseIcon(Heroicon::OutlinedXMark),    
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
                CreateAction::make(),
                //AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                //DissociateAction::make(),
                //DeleteAction::make(),
            ])
            ->toolbarActions([
                //BulkActionGroup::make([
                    //DissociateBulkAction::make(),
                    //DeleteBulkAction::make(),
                //])
            ]);
    }
}
