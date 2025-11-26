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
}
