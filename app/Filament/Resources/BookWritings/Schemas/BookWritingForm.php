<?php

namespace App\Filament\Resources\BookWritings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class BookWritingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('personal_info_id')
                    ->relationship('personalInfo', 'name')
                    ->required(),
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                LanguageTabs::make([
                    Textarea::make('title')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('publisher')
                        ->required(),
                ]),
                TextInput::make('isbn'),
                Select::make('type')
                    ->options([
                        'Textbook' => 'Textbook',
                        'ReferenceBook' => 'Reference Book',
                        'Monograph' => 'Monograph',
                        'Chapter' => 'Chapter',
                    ])
                    ->required(),
                TextInput::make('authors')
                    ->required(),
                Select::make('role')
                    ->options([
                        'Author' => 'Author',
                        'CoAuthor' => 'Co-Author',
                        'Editor' => 'Editor',
                    ])
                    ->required(),
                TextInput::make('url')
                    ->url(),
            ]);
    }
}
