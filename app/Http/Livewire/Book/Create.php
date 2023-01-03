<?php

namespace App\Http\Livewire\Book;

use App\Models\Author;
use App\Models\Genre;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.book.create')->with([
                "authors" => Author::all(),
                "genres" => Genre::all()
            ]);
    }
}
