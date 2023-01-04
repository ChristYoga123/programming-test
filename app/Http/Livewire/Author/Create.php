<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.author.create');
    }

    public function store()
    {
        $this->validate([
           "name" => ["required", "max:255"]
        ]);

        $author = Author::create([
            "name" => $this->name
        ]);

        $this->resetInput();
        $this->emit("authorStored", $author);
    }

    private function resetInput()
    {
        $this->name = null;
    }
}
