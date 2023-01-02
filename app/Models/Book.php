<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function Author()
    {
        return $this->belongsTo(Author::class);
    }

    public function BookGenres()
    {
        return $this->hasMany(BookGenre::class);
    }

    public function getImageAttribute($value)
    {
        return "storage/". $value;
    }
}
