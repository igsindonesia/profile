<?php

namespace App\Filament\Resources\IntellectualProperties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class IntellectualPropertyForm
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
                ]),
                Select::make('type')
                    ->options([
                        'Patent' => 'Patent',
                        'Copyright' => 'Copyright',
                        'Trademark' => 'Trademark',
                        'Design' => 'Design',
                        'Software' => 'Software',
                    ])
                    ->required(),
                TextInput::make('registration_number'),
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'Registered' => 'Registered',
                        'Pending' => 'Pending',
                        'Granted' => 'Granted',
                        'Published' => 'Published',
                    ])
                    ->required(),
                TextInput::make('url')
                    ->url(),
            ]);
    }
}
