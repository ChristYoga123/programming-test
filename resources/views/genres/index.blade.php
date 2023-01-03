<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Genre') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        {{-- Table --}}
        <div class="overflow-hidden mb-8 w-full rounded-lg">
            @livewire("genre.index")
        </div>
    </div>
</x-app-layout>
