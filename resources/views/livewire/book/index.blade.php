<div>
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
                        {{ $book->image }}
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
                                <li>{{ $genre->Genre->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route("books.edit", $book->id) }}">
                            <button class="btn btn-outline btn-warning">
                                <i class="fa fa-pen-to-square"></i>
                            </button>
                        </a>

                        <form action="{{ route("books.destroy", $book->id) }}" class="inline">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-outline btn-error"></button>
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