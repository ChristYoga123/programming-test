<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;

class Index extends Component
{
    public $authorId, $statusUpdate = false;
    protected $listeners = [
        "authorStored" => "handleStored",
        "authorUpdated" => "handleUpdated"
    ];
    public function render()
    {
        return view('livewire.author.index')->with([
            "authors" => Author::latest()->paginate(10)    
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

    
}
