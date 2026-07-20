<?php

namespace App\Filament\Resources\Competitions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CompetitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_id')
                    ->required(),
                TextInput::make('title_en')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('1000')
                    ->imageResizeTargetHeight('1000')
                    ->required(),
                Textarea::make('description_id')
                    ->columnSpanFull(),
                Textarea::make('description_en')
                    ->columnSpanFull(),
                TextInput::make('wa_number_1')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Nomor WhatsApp Admin 1' : 'WhatsApp Number Admin 1')
                    ->tel()
                    ->required()
                    ->default('62895414277027'),
                TextInput::make('wa_number_2')
                    ->label(fn () => app()->getLocale() == 'id' ? 'Nomor WhatsApp Admin 2' : 'WhatsApp Number Admin 2')
                    ->tel()
                    ->required()
                    ->default('62895414277027'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
