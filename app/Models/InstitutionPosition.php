<?php

namespace App\Models;

use Database\Factories\InstitutionPositionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class InstitutionPosition extends Model
{
    /** @use HasFactory<InstitutionPositionFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'position',
        'institution',
        'start_year',
        'end_year',
        'description',
    ];

    public array $translatable = ['position', 'institution', 'description'];

    protected function casts(): array
    {
        return [
            'position' => 'array',
            'institution' => 'array',
            'description' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
