<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class TrainingForm
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
                    TextInput::make('organizer')
                        ->required(),
                ]),
                Select::make('type')
                    ->options([
                        'Domestic' => 'Domestic',
                        'International' => 'International',
                    ])
                    ->required(),
                TextInput::make('duration_hours')
                    ->required()
                    ->numeric(),
                TextInput::make('period')
                    ->required(),
                TextInput::make('url')
                    ->url(),
            ]);
    }
}
