<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $paginate = 5;
    public $search;
    public $authorId, $statusUpdate = false;
    protected $listeners = [
        "authorStored" => "handleStored",
        "authorUpdated" => "handleUpdated",
        "cancelUpdated"
    ];
    public function render()
    {
        return view('livewire.author.index')->with([
            "authors" => $this->search === null ? 
                Author::latest()->paginate($this->paginate) :
                Author::latest()->where("name", "like" , "%".$this->search."%")->paginate($this->paginate)   
        ]);
    }

    public function handleStored($author)
    {
        session()->flash("success", "Data berhasil ditambah");
    }

    public function handleUpdated($author)
    {
        session()->flash("success", "Data berhasil diubah");
    }

    public function edit($authorId)
    {
        $this->statusUpdate = true;
        $author = Author::findOrFail($authorId);
        $this->emit("getAuthor", $author);
    }

    public function destroy($authorId)
    {
        $author = Author::findOrFail($authorId);
        $author->delete();
        session()->flash("success", "Data berhasil dihapus");
    }

    public function cancelUpdated($statusUpdate)
    {
        $this->statusUpdate = $statusUpdate;
    }
    
}
