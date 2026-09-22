<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\DocumentationCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocumentationCategories extends ListRecords
{
    protected static string $resource = DocumentationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
