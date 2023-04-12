<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    /**
     * Get the Library the Book is registered to.
     */
    public function libary(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    /**
     * Get the User which has borrowed the book.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
