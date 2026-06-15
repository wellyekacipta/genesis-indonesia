<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_id')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('title_en')
                    ->required(),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->dehydrated()
                    ->required(),
                RichEditor::make('content_id')
                    ->columnSpanFull(),
                RichEditor::make('content_en')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                FileUpload::make('pdf_file')
                    ->label(fn () => app()->getLocale() == 'id' ? 'File PDF (Lampiran)' : 'PDF File (Attachment)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('articles/pdfs')
                    ->preserveFilenames()
                    ->maxSize(10240), // 10MB
                TextInput::make('seo_title'),
                Textarea::make('seo_description')
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
