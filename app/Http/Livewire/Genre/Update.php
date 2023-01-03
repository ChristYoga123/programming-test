<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;

class Update extends Component
{
    public $genreId;
    public $name;
    protected $listeners = [
        "getGenre" => "showGenre"
    ];
    public function render()
    {
        return view('livewire.genre.update');
    }

    public function showGenre($genre)
    {
        $this->genreId = $genre["id"];
        $this->name = $genre["name"];
    }

    public function update()
    {
        $this->validate([
            "name" => ["required", "max:255", "unique:genres,name,".$this->genreId]
        ]);

        $genre = Genre::findOrFail($this->genreId);
        $genre->update([
            "name" => $this->name
        ]);
        $this->resetInput();
        $this->emit("genreUpdated", $genre);

    }

    private function resetInput()
    {
        $this->name = null;
    }
}
