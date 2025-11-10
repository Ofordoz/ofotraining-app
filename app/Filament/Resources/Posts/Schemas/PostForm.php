<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Tabs::make('Tab')
                 ->tabs([
            
                   Tab::make('Creazione Post')   
                     ->icon('heroicon-s-newspaper')
                     ->schema([
                        TextInput::make('title')
                            ->minLength(2)
                            ->maxLength(10)
                            ->required(),
                        TextInput::make('slug')
                            ->required(),
                        ColorPicker::make('color')
                            ->required(),
                        Select::make('category_id')
                            ->label('Categorie')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),    
                        MarkdownEditor::make('content')
                            ->required()
                            ->columnSpan(4),   
                        ]),
               
                   Tab::make('Immagine')
                      ->icon('heroicon-s-cloud')
                      ->schema([
                       FileUpload::make('thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('thumbnail')
                            ->visibility('public'), 
                        ]),
                
                   Tab::make('Meta')
                     ->icon('heroicon-s-share')
                     ->schema([
                        TagsInput::make('tags')
                            ->required(),
                // Select::make('autori') 
                //     ->multiple()
                //     ->preload()
                //     ->relationship('autori','name'),   
                        Checkbox::make('published'),
                        ])
               
                 ])->activeTab(1)
            ])->columns(1);
    }
}
