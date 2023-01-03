<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\BookGenre;
use Livewire\Component;

class Edit extends Component
{
    public $book_id;

    public function render()
    {
        return view('livewire.book.edit')->with([
            "authors" => Author::all(),
            "genres" => Genre::all(),
            "book" => Book::with("Author")->findOrFail($this->book_id),
            "book_genre" => BookGenre::whereBookId($this->book_id)->get()->pluck("genre_id")->toArray()
        ]);
    }
}
