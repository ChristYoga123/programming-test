<div>
    <form wire:submit.prevent="update" class="flex gap-3">
        @csrf
        @method("PUT")
        <input type="hidden" wire:model="genreId">
        <div class="flex flex-col gap-2">
            <label for="name" class="font-semibold text-sm">Nama</label>
            <input type="text"
                   wire:model="name"
                   id="name"
                   class="input input-primary w-full max-w-xs
                   @error("name")
                       input-error
                   @enderror"
                   value="{{ old("name", $name) }}">
            @error('name')
                <small class="text-red-700">
                    {{ $message }}
                </small>
            @enderror
                </div>
        <button class="btn btn-outline btn-warning mt-7">Ubah</button>
    </form>
</div>
