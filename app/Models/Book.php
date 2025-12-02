<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'isbn',
        'author',
        'publisher',
        'edition',
        'publication_year',
        'subject',
        'educational_level',
        'description',
        'price',
        'stock',
        'cover_image',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_year' => 'integer',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the digital resources associated with the book.
     */
    public function resources(): HasMany
    {
        return $this->hasMany(BookResource::class);
    }

    /**
     * Get the chapters associated with the book.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(BookChapter::class)->whereNull('parent_id')->orderBy('order');
    }

    /**
     * Get all chapters (including subchapters) associated with the book.
     */
    public function allChapters(): HasMany
    {
        return $this->hasMany(BookChapter::class)->orderBy('order');
    }
}
