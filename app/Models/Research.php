<?php

namespace App\Models;

use Database\Factories\ResearchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Research extends Model
{
    /** @use HasFactory<ResearchFactory> */
    use HasFactory;

    use HasTranslations;

    protected $table = 'researches';

    protected $fillable = [
        'personal_info_id',
        'year',
        'title',
        'role',
        'funding_source',
        'scheme',
        'fund_amount',
    ];

    public array $translatable = ['title', 'funding_source', 'scheme'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'funding_source' => 'array',
            'scheme' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
