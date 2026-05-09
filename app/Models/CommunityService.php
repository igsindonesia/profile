<?php

namespace App\Models;

use Database\Factories\CommunityServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CommunityService extends Model
{
    /** @use HasFactory<CommunityServiceFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'year',
        'title',
        'role',
        'funding_source',
        'fund_amount',
    ];

    public array $translatable = ['title', 'funding_source'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'funding_source' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
