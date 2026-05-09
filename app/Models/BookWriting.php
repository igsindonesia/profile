<?php

namespace App\Models;

use Database\Factories\BookWritingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class BookWriting extends Model
{
    /** @use HasFactory<BookWritingFactory> */
    use HasFactory;

    use HasTranslations;

    public $fillable = [
        'personal_info_id',
        'year',
        'title',
        'publisher',
        'isbn',
    ];

    public array $translatable = ['title', 'publisher'];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'publisher' => 'array',
        ];
    }

    public function personalInfo(): BelongsTo
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
