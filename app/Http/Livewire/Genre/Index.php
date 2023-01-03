<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;

class Index extends Component
{
    public $statusUpdate = false;
    protected $listeners = [
        "genreStored" => "handleStored",
        "genreUpdated" => "handleUpdated"
    ];

    public function render()
    {
        return view('livewire.genre.index')->with([
            "genres" => Genre::latest()->paginate(10)
        ]);
    }
    
    public function handleStored($genre)
    {
        session()->flash("success", "Data berhasil ditambahkan");
    }

    public function handleUpdated($genre)
    {
        session()->flash("success", "Data berhasil diubah");
    }

    public function edit($genreId)
    {
        $this->statusUpdate = true;
        $genre = Genre::findOrFail($genreId);
        $this->emit("getGenre", $genre);
    }

    public function destroy($genreId)
    {
        $genre = Genre::findOrFail($genreId);
        $genre->delete();
        session()->flash("success", "Data berhasil dihapus");
    }
}
