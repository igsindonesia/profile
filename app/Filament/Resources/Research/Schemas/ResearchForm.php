<?php

namespace App\Filament\Resources\Research\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class ResearchForm
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
                    TextInput::make('funding_source')
                        ->required(),
                    TextInput::make('scheme')
                        ->required(),
                ]),
                Select::make('role')
                    ->options([
                        'Leader' => 'Leader',
                        'Member' => 'Member',
                    ])
                    ->required(),
                TextInput::make('fund_amount')
                    ->required()
                    ->numeric(),
            ]);
    }
}
