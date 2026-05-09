<?php

namespace App\Models;

use Database\Factories\IntellectualPropertyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class IntellectualProperty extends Model
{
    /** @use HasFactory<IntellectualPropertyFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'title',
        'type',
        'registration_number',
        'year',
        'status',
        'url',
    ];

    public array $translatable = ['title'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
