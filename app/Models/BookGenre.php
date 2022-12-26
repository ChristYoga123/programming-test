<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function Book()
    {
        return $this->belongsTo(Book::class);
    }

    public function Genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
