<?php

namespace App\Models;

use Database\Factories\EducationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Education extends Model
{
    /** @use HasFactory<EducationFactory> */
    use HasFactory;

    use HasTranslations;

    protected $table = 'educations';

    protected $fillable = [
        'personal_info_id',
        'level',
        'institution',
        'department',
        'graduation_year',
        'thesis_title',
        'advisor',
    ];

    public array $translatable = ['department', 'thesis_title'];

    protected function casts(): array
    {
        return [
            'department' => 'array',
            'thesis_title' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
