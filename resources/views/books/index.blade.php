<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Buku') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        @if (session()->has("success"))
            <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
                <div class="flex justify-center items-center w-12 bg-green-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-green-500">Sukses</span>
                        <p class="text-sm text-gray-600">{{ session("success") }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="overflow-hidden mb-8 w-full rounded-lg">
            <div class="add-button mb-3">
                <a href="{{ route("books.create") }}">
                    <button class="btn btn-outline btn-primary">
                        Tambah Buku
                    </button>
                </a>
            </div>
            @livewire("book.index")
        </div>

    </div>
</x-app-layout>
