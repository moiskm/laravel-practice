<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookChapter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'parent_id',
        'title',
        'description',
        'color',
        'icon',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the book that owns the chapter.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the parent chapter (if this is a subchapter/topic).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BookChapter::class, 'parent_id');
    }

    /**
     * Get the child chapters (subchapters/topics).
     */
    public function children(): HasMany
    {
        return $this->hasMany(BookChapter::class, 'parent_id')->orderBy('order');
    }

    /**
     * Scope a query to only include main chapters (no parent).
     */
    public function scopeMainChapters($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope a query to only include subchapters (has parent).
     */
    public function scopeSubchapters($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
