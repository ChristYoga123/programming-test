<div>
    <hr class="my-5">

    <div class="flex justify-between">
        <select wire:model="paginate" class="select ml-1 mb-3 border border-gray-300">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select>

        <div class="flex gap-1 mr-1">
            <p class="text-lg mt-2 mr-1">Filter</p>
            <select wire:model="filter_by" class="select mr-1 mb-3 border border-gray-300">
                <option value="judul">Judul</option>
                <option value="genre">Genre</option>
            </select>
            
            @if ($filter_by === "judul")
                <input type="text"
                       class="input w-full max-w-xs border border-gray-300"
                       wire:model="judul"
                       placeholder="Ketikkan judul">
            @else
                <select wire:model="genre_1"
                        class="select border border-gray-300 w-[150px]">
                    <option value="" selected>Genre 1</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>

                <select wire:model="genre_2"
                        class="select border border-gray-300 w-[150px]">
                    <option value="" selected>Genre 2</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>

                <select wire:model="genre_3"
                        class="select border border-gray-300 w-[150px]">
                    <option value="" selected>Genre 3</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                <th class="px-4 py-3">Judul</th>
                <th class="px-4 py-3">Gambar</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3">Penulis</th>
                <th class="px-4 py-3">Genre</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y">
            @foreach($books as $book)
                <tr class="text-gray-700">
                    <td class="px-4 py-3 text-sm">
                        {{ $book->title }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <img src="{{ asset('storage/'.$book->image) }}" alt="gambar {{ $book->title }}" width="200px">
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $book->price }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $book->Author->name }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <ul>
                            @foreach ($book->BookGenres as $genre)
                                <li>
                                    <i class="fa fa-circle"></i>  {{ $genre->Genre->name }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route("books.edit", $book->id) }}">
                            <button class="btn btn-outline btn-warning">
                                <i class="fa fa-pen-to-square"></i>
                            </button>
                        </a>

                        <form action="{{ route("books.destroy", $book->id) }}" class="inline" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-outline btn-error">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        {{ $books->links() }}
    </div>
</div>