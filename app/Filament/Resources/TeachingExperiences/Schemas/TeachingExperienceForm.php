<?php

namespace App\Filament\Resources\TeachingExperiences\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class TeachingExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('personal_info_id')
                    ->relationship('personalInfo', 'name')
                    ->required(),
                LanguageTabs::make([
                    TextInput::make('course_name')
                        ->required(),
                    TextInput::make('program')
                        ->required(),
                ]),
                Select::make('level')
                    ->options([
                        'Diploma' => 'Diploma',
                        'Bachelor' => 'Bachelor',
                        'Master' => 'Master',
                        'Doctorate' => 'Doctorate',
                    ])
                    ->required(),
                TextInput::make('institution')
                    ->required(),
                TextInput::make('academic_year')
                    ->required(),
            ]);
    }
}
