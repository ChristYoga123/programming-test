<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;

class Update extends Component
{
    public $authorId, $name;
    protected $listeners = [
        "getAuthor" => "showAuthor"
    ];
    public function render()
    {
        return view('livewire.author.update');
    }

    public function showAuthor($author)
    {
        $this->authorId = $author["id"];
        $this->name = $author["name"];
    }

    public function update()
    {
        $this->validate([
            "name" => ["required", "max:255"]
        ]);

        $author = Author::findOrFail($this->authorId);
        $author->update([
            "name" => $this->name
        ]);
        $this->resetInput();
        $this->emit("authorUpdated", $author);

    }

    private function resetInput()
    {
        $this->name = null;
    }

    public function cancel()
    {
        $statusUpdate = false;
        $this->emit("cancelUpdated", $statusUpdate);
    }
}
