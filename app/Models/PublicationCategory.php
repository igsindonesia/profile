<?php

namespace App\Models;

use Database\Factories\PublicationCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Spatie\Translatable\HasTranslations;

class PublicationCategory extends Model
{
    /** @use HasFactory<PublicationCategoryFactory> */
    use HasFactory;

    use HasTranslations;
    use ModelTree;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'code',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'order' => 'integer',
            'is_active' => 'boolean',
            'title' => 'array',
            'description' => 'array',
        ];
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
