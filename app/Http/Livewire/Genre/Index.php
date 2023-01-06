<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public $paginate = 5;
    public $search;
    public $statusUpdate = false;
    protected $listeners = [
        "genreStored" => "handleStored",
        "genreUpdated" => "handleUpdated",
        "cancelUpdated"
    ];

    public function render()
    {
        return view('livewire.genre.index')->with([
            "genres" => $this->search === null ? 
                Genre::latest()->paginate($this->paginate) :
                Genre::latest()->where("name", "like" , "%".$this->search."%")->paginate($this->paginate)
        ]);
    }
    
    public function cancelUpdated($statusUpdate)
    {
        $this->statusUpdate = $statusUpdate;
    }
    
    public function handleStored($genre)
    {
        session()->flash("success", "Data berhasil ditambahkan");
    }

    public function handleUpdated($genre)
    {
        $this->statusUpdate = false;
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
