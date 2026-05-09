<?php

namespace App\Models;

use Database\Factories\ConferenceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Conference extends Model
{
    /** @use HasFactory<ConferenceFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'year',
        'title',
        'conference_name',
        'location',
        'role',
        'paper_title',
        'url',
    ];

    public array $translatable = ['title', 'conference_name', 'location', 'paper_title'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'conference_name' => 'array',
            'location' => 'array',
            'paper_title' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
