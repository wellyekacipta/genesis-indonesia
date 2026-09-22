<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\DocumentationCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentationCategory extends CreateRecord
{
    protected static string $resource = DocumentationCategoryResource::class;
}
