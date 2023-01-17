<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'year', 'author_id'
    ];

    public function author() {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function library() {
        return $this->belongsToMany(Library::class, 'library_book');
    }

}
