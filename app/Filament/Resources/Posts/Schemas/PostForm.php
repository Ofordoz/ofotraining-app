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
use Filament\Schemas\Components\Group;
use Filament\Support\Icons\Heroicon;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

               Section::make('Creazione Post')
                  ->description('Funziona! gloria a voi')
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
                Select::make('category_id')
                    ->label('Categorie')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
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
                // Select::make('autori') 
                //     ->multiple()
                //     ->preload()
                //     ->relationship('autori','name'),   
                Checkbox::make('published'),
                  ])
              ]) 

            ])->columns(3);
    }
}
