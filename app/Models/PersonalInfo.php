<?php

namespace App\Models;

use Database\Factories\PersonalInfoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonalInfo extends Model
{
    /** @use HasFactory<PersonalInfoFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'picture',
        'short_description',
        'academic_titles',
        'nidn',
        'nip',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'functional_position',
        'structural_position',
        'academic_position',
        'institution',
        'address_office',
        'address_home',
        'phone',
        'email',
        'produced_graduates_s1',
        'produced_graduates_s2',
        'produced_graduates_s3',
        'scopus_id',
        'sinta_id',
        'google_scholar_id',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'short_description' => 'array',
        ];
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    public function teachingExperiences(): HasMany
    {
        return $this->hasMany(TeachingExperience::class);
    }

    public function teachingMaterials(): HasMany
    {
        return $this->hasMany(TeachingMaterial::class);
    }

    public function researches(): HasMany
    {
        return $this->hasMany(Research::class);
    }

    public function communityServices(): HasMany
    {
        return $this->hasMany(CommunityService::class);
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public function bookWritings(): HasMany
    {
        return $this->hasMany(BookWriting::class);
    }

    public function conferences(): HasMany
    {
        return $this->hasMany(Conference::class);
    }

    public function intellectualProperties(): HasMany
    {
        return $this->hasMany(IntellectualProperty::class);
    }

    public function policyExperiences(): HasMany
    {
        return $this->hasMany(PolicyExperience::class);
    }

    public function institutionPositions(): HasMany
    {
        return $this->hasMany(InstitutionPosition::class);
    }

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class);
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
