<?php

namespace App\Models;

use Database\Factories\AwardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Award extends Model
{
    /** @use HasFactory<AwardFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'year',
        'title',
        'organization',
        'description',
        'url',
    ];

    public array $translatable = ['title', 'organization', 'description'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'organization' => 'array',
            'description' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
