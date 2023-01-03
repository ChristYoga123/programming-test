<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.genre.create');
    }

    public function store()
    {
        $this->validate([
            "name" => ["required", "max:255", "unique:genres,name"]
        ]);

        $genre = Genre::create([
            "name" => $this->name
        ]);

        $this->resetInput();
        $this->emit("genreStored", $genre);
    }

    private function resetInput()
    {
        $this->name = null;
    }
}
