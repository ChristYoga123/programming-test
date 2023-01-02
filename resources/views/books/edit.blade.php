<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Buku') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="overflow-hidden mb-8 w-full rounded-lg">
            @livewire("book.edit", ["book_id" => $book->id])
        </div>

    </div>
</x-app-layout>
