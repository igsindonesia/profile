<?php

namespace App\Models;

use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Organization extends Model
{
    /** @use HasFactory<OrganizationFactory> */
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'personal_info_id',
        'organization_name',
        'role',
        'membership_type',
        'start_year',
        'end_year',
    ];

    public array $translatable = ['organization_name', 'role'];

    protected function casts(): array
    {
        return [
            'organization_name' => 'array',
            'role' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
