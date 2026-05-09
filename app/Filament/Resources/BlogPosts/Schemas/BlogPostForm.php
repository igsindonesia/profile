<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('personal_info_id')
                    ->relationship('personalInfo', 'name')
                    ->required(),
                LanguageTabs::make([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            if (! $get('slug')) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->columnSpanFull(),
                ]),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('URL-friendly version of the title'),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required()
                    ->live(),
                DatePicker::make('published_at')
                    ->label('Publish Date')
                    ->visible(fn ($get) => $get('status') === 'published')
                    ->required(fn ($get) => $get('status') === 'published'),
                LanguageTabs::make([
                    Textarea::make('excerpt')
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),
                ]),
                LanguageTabs::make([
                    RichEditor::make('content')
                        ->required()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('blog-content')
                        ->columnSpanFull(),
                ])->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->collection('featured_image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(5120)
                    ->helperText('Upload a featured image for the blog post (max 5MB)')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('gallery')
                    ->label('Gallery Images')
                    ->collection('gallery')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->maxFiles(10)
                    ->helperText('Upload up to 10 images for the gallery')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('attachments')
                    ->label('File Attachments')
                    ->collection('attachments')
                    ->multiple()
                    ->reorderable()
                    ->maxSize(10240)
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->helperText('Upload PDF, Word, or Excel files (max 10MB each)')
                    ->columnSpanFull(),
                LanguageTabs::make([
                    Textarea::make('meta_description')
                        ->label('Meta Description')
                        ->rows(2)
                        ->maxLength(160)
                        ->helperText('Recommended: 150-160 characters')
                        ->columnSpanFull(),
                ]),
            ]);
    }
}
