<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function BookGenres()
    {
        return $this->hasMany(BookGenre::class);
    }

    public function getNameAttribute($value)
    {
        return $value . "/" . trans("genre." . $value, [], "id");
    }
}
