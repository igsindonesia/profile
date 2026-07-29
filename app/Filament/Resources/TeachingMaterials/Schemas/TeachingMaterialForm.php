<?php

namespace App\Filament\Resources\TeachingMaterials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class TeachingMaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('personal_info_id')
                    ->relationship('personalInfo', 'name')
                    ->required(),
                LanguageTabs::make([
                    Textarea::make('title')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('program')
                        ->required(),
                    TextInput::make('type')
                        ->required(),
                ]),
                Select::make('format')
                    ->options([
                        'Printed' => 'Printed',
                        'Digital' => 'Digital',
                    ])
                    ->required(),
                TextInput::make('isbn'),
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                TextInput::make('url')
                    ->url(),
            ]);
    }
}
