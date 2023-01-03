<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.book.index')->with([
                "books" => Book::with("Author")->latest()->paginate(10)
            ]);
    }
}
