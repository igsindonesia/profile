<?php

namespace App\Models;

use Database\Factories\PublicationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    /** @use HasFactory<PublicationFactory> */
    use HasFactory;

    protected $fillable = [
        'personal_info_id',
        'publication_category_id',
        'year',
        'title',
        'publication_type',
        'journal_name',
        'doi',
        'url',
        'publisher',
        'index_type',
        'rank',
        'author_role',
    ];

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }

    public function publicationCategory(): BelongsTo
    {
        return $this->belongsTo(PublicationCategory::class);
    }
}
