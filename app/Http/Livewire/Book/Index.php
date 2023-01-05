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
           $filter_by = "judul",
           $genre_1,
           $genre_2,
           $genre_3;
    public function render()
    {
        $books = Book::with(["Author", "BookGenres.Genre"]);
        if($this->filter_by === "judul")
        {
            if($this->judul != null){
                $books = $books->where("title", "like", "%".$this->judul."%");
            }
            $this->genre_1 = null;
            $this->genre_2 = null;
            $this->genre_3 = null;
        }

        if($this->filter_by === "genre"){
            $genre_array = [];
            if($this->genre_1 != null || $this->genre_2 != null || $this->genre_3 != null){
                $genre_array[] = $this->genre_1;
                $genre_array[] = $this->genre_2;
                $genre_array[] = $this->genre_3;

                $books = $books->whereHas("BookGenres.Genre", function($query) use ($genre_array){
                    $query->whereIn("id", $genre_array);
                });
            }
        }
        $books = $books->paginate($this->paginate);

        return view('livewire.book.index')->with([
            "books" => $books, 
            "genres" => Genre::all()
        ]);
    }
}
