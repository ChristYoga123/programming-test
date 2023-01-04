<div>
    <form wire:submit.prevent="store" class="flex gap-3">
        <div class="flex flex-col gap-2">
            <label for="name" class="font-semibold text-sm">Nama</label>
            <input type="text"
                   wire:model="name"
                   id="name"
                   class="input input-primary w-full max-w-xs
                   @error("name")
                       input-error
                   @enderror">
            @error('name')
                <small class="text-red-700">
                    {{ $message }}
                </small>
            @enderror
                </div>
        <button class="btn btn-outline btn-primary mt-7">Tambah</button>
    </form>
</div>
