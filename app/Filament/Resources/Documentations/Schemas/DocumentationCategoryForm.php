<?php

namespace App\Filament\Resources\Documentations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DocumentationCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn () => app()->getLocale() == 'id' ? 'Informasi Kategori Dokumentasi' : 'Documentation Category Info')
                    ->schema([
                        TextInput::make('title_id')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Judul Kategori (Bahasa Indonesia)' : 'Category Title (Indonesian)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('title_en')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Judul Kategori (Bahasa Inggris)' : 'Category Title (English)')
                            ->required(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        FileUpload::make('cover_image')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Foto Sampul Kategori' : 'Category Cover Image')
                            ->image()
                            ->disk('public')
                            ->directory('documentation/covers')
                            ->visibility('public'),
                        Textarea::make('description_id')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Deskripsi Singkat (Bahasa Indonesia)' : 'Short Description (Indonesian)')
                            ->columnSpanFull(),
                        Textarea::make('description_en')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Deskripsi Singkat (Bahasa Inggris)' : 'Short Description (English)')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label(fn () => app()->getLocale() == 'id' ? 'Tampilkan di Website' : 'Show on Website')
                            ->default(true),
                    ])->columns(2),

                Section::make(fn () => app()->getLocale() == 'id' ? 'Koleksi Foto Galeri Dokumentasi' : 'Documentation Photo Collection')
                    ->description(fn () => app()->getLocale() == 'id' ? 'Tambahkan foto-foto dokumentasi yang masuk ke dalam kategori ini' : 'Add documentation photos belonging to this category')
                    ->schema([
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('image')
                                    ->label(fn () => app()->getLocale() == 'id' ? 'File Foto' : 'Photo File')
                                    ->image()
                                    ->disk('public')
                                    ->directory('documentation/photos')
                                    ->visibility('public')
                                    ->required(),
                                TextInput::make('title_id')
                                    ->label(fn () => app()->getLocale() == 'id' ? 'Keterangan Foto (ID)' : 'Photo Caption (ID)'),
                                TextInput::make('title_en')
                                    ->label(fn () => app()->getLocale() == 'id' ? 'Keterangan Foto (EN)' : 'Photo Caption (EN)'),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->collapsible()
                            ->reorderable('sort_order')
                            ->addActionLabel(fn () => app()->getLocale() == 'id' ? '+ Tambah Foto Dokumentasi' : '+ Add Documentation Photo'),
                    ]),
            ]);
    }
}
