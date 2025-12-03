<?php

namespace App\Models;

//Importación de clases


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;//relaciones

use Illuminate\Database\Eloquent\Relations\HasMany;//relaciones

class BookChapter extends Model
{

//campos que se pueden actualizar o guardar.
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

//?
    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

//Cada capítulo pertenece a un Book.//muchos a uno

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }


//Capítulo tiene un padre
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BookChapter::class, 'parent_id');
    }
//Capítulo tiene subcapítulos
    public function children(): HasMany
    {
        return $this->hasMany(BookChapter::class, 'parent_id')->orderBy('order');
    }

//Filtra solo capítulos principales
    public function scopeMainChapters($query)
    {
        return $query->whereNull('parent_id');
    }

//Filtra solo subcapítulos
    public function scopeSubchapters($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
