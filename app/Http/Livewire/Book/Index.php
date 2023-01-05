<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 5;
    public $judul,
           $genre_1,
           $genre_2,
           $genre_3;
    public function render()
    {
                $books = Book::with(["Author", "BookGenres.Genre"]);

        if ($this->judul !== null || $this->genre_1 !== null || $this->genre_2 !== null || $this->genre_3 !== null) {
            $genres = [];
            if ($this->genre_1 !== null) {
                $genres[] = $this->genre_1;
            }
            if ($this->genre_2 !== null) {
                $genres[] = $this->genre_2;
            }
            if ($this->genre_3 !== null) {
                $genres[] = $this->genre_3;
            }

            $books = $books->where(function ($query) use ($genres) {
                $query->WhereHas("BookGenres", function($query) use ($genres) {
                        $query->whereIn("genre_id", $genres);
                })->orWhere("title", "like", "%".$this->judul."%");
            });
        }

        $books = $books->paginate($this->paginate);

        return view('livewire.book.index')->with([
            "books" => $books, 
            "genres" => Genre::all()
        ]);
    }
}
