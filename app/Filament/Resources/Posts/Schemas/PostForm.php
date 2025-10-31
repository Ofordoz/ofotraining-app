<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use app\Models\Category;
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

               Section::make('sono un header')
                  ->description('Funziona! gloria a voi (sono una descrizione)')
                  ->icon(Heroicon::Trophy)
                  ->schema([ 
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug'),
                ColorPicker::make('color')
                    ->required(),
                Select::make('category_id')
                    ->label('Categorie')
                    ->searchable()
                    ->options(Category::all()->pluck('name','id')),     
                MarkdownEditor::make('content')
                    ->columnSpan(2)
                    ->required(),   
               ])->columnSpan(2) ->columns(2),     
               
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
                  ->schema([
                TagsInput::make('tags')
                    ->required(),
                Checkbox::make('published')
                    ->required(),
                  ])
              ])  
            ])->columns(4);
    }
}
