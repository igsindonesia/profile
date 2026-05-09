<?php

namespace App\Models;

use Database\Factories\TrainingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Training extends Model
{
    /** @use HasFactory<TrainingFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'year',
        'title',
        'type',
        'organizer',
        'duration_hours',
        'period',
        'url',
    ];

    public array $translatable = ['title', 'organizer'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'organizer' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
