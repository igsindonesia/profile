<?php

namespace App\Filament\Resources\PersonalInfos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class PersonalInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('picture')
                            ->image()
                            ->disk('public')
                            ->directory('personal-info')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        FileUpload::make('cv_en')
                            ->label('Curriculum Vitae (English)')
                            ->disk('public')
                            ->directory('personal-info/cv')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->columnSpanFull(),
                        FileUpload::make('cv_id')
                            ->label('Curriculum Vitae (Indonesian)')
                            ->disk('public')
                            ->directory('personal-info/cv')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->columnSpanFull(),
                        LanguageTabs::make([
                            Textarea::make('short_description')
                                ->label('Short Description')
                                ->rows(3)
                                ->maxLength(500),
                        ])
                            ->columnSpanFull(),
                        TextInput::make('academic_titles')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nidn')
                            ->label('NIDN')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('birth_place')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('birth_date')
                            ->required()
                            ->native(false),
                        Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->required(),
                        TextInput::make('marital_status')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Position & Affiliation')
                    ->schema([
                        TextInput::make('functional_position')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('structural_position')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('academic_position')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('institution')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        Textarea::make('address_office')
                            ->required()
                            ->rows(3),
                        Textarea::make('address_home')
                            ->required()
                            ->rows(3),
                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Academic Profile')
                    ->schema([
                        TextInput::make('produced_graduates_s1')
                            ->label('S1 Graduates Produced')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('produced_graduates_s2')
                            ->label('S2 Graduates Produced')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('produced_graduates_s3')
                            ->label('S3 Graduates Produced')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('scopus_id')
                            ->label('Scopus ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('sinta_id')
                            ->label('Sinta ID')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('google_scholar_id')
                            ->label('Google Scholar ID')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(3),
            ]);
    }
}
