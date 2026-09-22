<?php

namespace App\Filament\Resources\Documentations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentationCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Sampul' : 'Cover')
                    ->square(),
                TextColumn::make('title_id')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Judul Kategori (ID)' : 'Category Title (ID)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title_en')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Judul Kategori (EN)' : 'Category Title (EN)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('photos_count')
                    ->counts('photos')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Jumlah Foto' : 'Photo Count')
                    ->badge()
                    ->color('success'),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
