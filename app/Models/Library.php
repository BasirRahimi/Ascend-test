<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Library extends Model
{
    use HasFactory;

    protected $table = 'libraries';

    /**
     * Get the users that are registered to this library.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the books that are registered to this library.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
