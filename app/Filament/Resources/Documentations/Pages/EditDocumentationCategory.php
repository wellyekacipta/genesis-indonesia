<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\DocumentationCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocumentationCategory extends EditRecord
{
    protected static string $resource = DocumentationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
