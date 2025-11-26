<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookResource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'type',
        'title',
        'file_path',
        'external_url',
        'duration_seconds',
        'display_order',
        'description',
        'metadata',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration_seconds' => 'integer',
        'display_order' => 'integer',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the book that owns the resource.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
