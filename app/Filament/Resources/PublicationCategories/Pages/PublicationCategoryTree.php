<?php

namespace App\Filament\Resources\PublicationCategories\Pages;

use App\Filament\Resources\PublicationCategories\PublicationCategoryResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Actions;
use SolutionForest\FilamentTree\Resources\Pages\TreePage;

class PublicationCategoryTree extends TreePage
{
    protected static string $resource = PublicationCategoryResource::class;

    protected static int $maxDepth = 3;

    protected ?string $treeTitle = 'Publication Categories';

    protected bool $enableTreeTitle = true;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            TextInput::make('code')
                ->maxLength(255)
                ->placeholder('e.g., J, P, B'),
            Textarea::make('description')
                ->rows(3),
            Toggle::make('is_active')
                ->default(true),
        ];
    }

    protected function getTreeToolbarActions(): array
    {
        return [
            Action::make('list_view')
                ->label('List View')
                ->icon('heroicon-o-list-bullet')
                ->url(PublicationCategoryResource::getUrl('list')),
            Actions\CreateAction::make()
                ->label('New Category')
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function hasDeleteAction(): bool
    {
        return true;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }

    protected function hasViewAction(): bool
    {
        return false;
    }

    public function getTreeRecordIcon(?Model $record = null): ?string
    {
        if (! $record) {
            return null;
        }

        // Root categories get a folder icon
        if ($record->parent_id === -1) {
            return 'heroicon-o-folder';
        }

        // Child categories get a tag icon
        return 'heroicon-o-tag';
    }

    public function getTreeRecordTitle(?Model $record = null): string
    {
        if (! $record) {
            return '';
        }

        $title = $record->title;

        // Add code if present
        if ($record->code) {
            $title = "[{$record->code}] {$title}";
        }

        // Add inactive indicator
        if (! $record->is_active) {
            $title = "🚫 {$title}";
        }

        return $title;
    }
}
