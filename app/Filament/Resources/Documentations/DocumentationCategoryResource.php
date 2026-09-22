<?php

namespace App\Filament\Resources\Documentations;

use App\Filament\Resources\Documentations\Pages\CreateDocumentationCategory;
use App\Filament\Resources\Documentations\Pages\EditDocumentationCategory;
use App\Filament\Resources\Documentations\Pages\ListDocumentationCategories;
use App\Filament\Resources\Documentations\Schemas\DocumentationCategoryForm;
use App\Filament\Resources\Documentations\Tables\DocumentationCategoriesTable;
use App\Models\DocumentationCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocumentationCategoryResource extends Resource
{
    protected static ?string $model = DocumentationCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    protected static ?string $recordTitleAttribute = 'title_id';

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() == 'id' ? 'Dokumentasi & Galeri' : 'Documentation & Gallery';
    }

    public static function getModelLabel(): string
    {
        return app()->getLocale() == 'id' ? 'Kategori Dokumentasi' : 'Documentation Category';
    }

    public static function getPluralModelLabel(): string
    {
        return app()->getLocale() == 'id' ? 'Dokumentasi & Galeri' : 'Documentation & Gallery';
    }

    public static function form(Schema $schema): Schema
    {
        return DocumentationCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentationCategoriesTable::configure($table);
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
            'index' => ListDocumentationCategories::route('/'),
            'create' => CreateDocumentationCategory::route('/create'),
            'edit' => EditDocumentationCategory::route('/{record}/edit'),
        ];
    }
}
