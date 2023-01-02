<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Livewire\Component;

class Edit extends Component
{
    public $book_id;

    public function render()
    {
        return view('livewire.book.edit')->with([
            "authors" => Author::all(),
            "genres" => Genre::all(),
            "book" => Book::with(["Author", "BookGenres"])->findOrFail($this->book_id)
        ]);
    }
}
