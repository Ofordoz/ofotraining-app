<?php

namespace App\Filament\Resources\Commentis;

use App\Filament\Resources\Commentis\Pages\CreateCommenti;
use App\Filament\Resources\Commentis\Pages\EditCommenti;
use App\Filament\Resources\Commentis\Pages\ListCommentis;
use App\Filament\Resources\Commentis\Schemas\CommentiForm;
use App\Filament\Resources\Commentis\Tables\CommentisTable;
use App\Models\Commenti;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CommentiResource extends Resource
{
    protected static ?string $model = Commenti::class;

    protected static ?string $modelLabel = 'Commenti ';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CommentiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommentisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCommentis::route('/'),
            'create' => CreateCommenti::route('/create'),
            'edit' => EditCommenti::route('/{record}/edit'),
        ];
    }
}
