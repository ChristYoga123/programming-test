<div>
    <div>
        <form action="{{ route("books.update", $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="ml-3 mb-3 flex flex-col">
                <label for="title" class="text-lg font-semibold mb-2">Judul Buku</label>
                <input type="text"
                       placeholder="Masukkan judul" 
                       name="title"
                       id="title"
                       class="input input-bordered input-primary w-full max-w-xs
                              @error("title")
                                input-error
                              @enderror"
                        value="{{ old("title", $book->title) }}" />
                @error("title")
                    <small class="text-red-700">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    
            <div class="ml-3 mb-3 flex flex-col">
                <label for="image" class="text-lg font-semibold mb-2">Gambar Buku</label>
                @if ($book->image)
                    <img src="{{ asset('storage/'. $book->image) }}" class="image-preview block mb-2 rounded-md" width="300px">
                @endif
                <img class="image-preview block mb-2 rounded-md" width="300px">
                <input type="hidden" name="old_image" value="{{ $book->image }}">
                <input type="file" 
                       name="image"
                       id="image"
                       class="file-input file-input-bordered file-input-primary w-full max-w-xs
                              @error("title")
                                file-input-error
                              @enderror" 
                        onchange="previewImage()"/>
                @error("image")
                    <small class="text-red-700">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    
            <div class="ml-3 mb-3 flex flex-col">
                <label for="price" class="text-lg font-semibold mb-2">Harga Buku</label>
                <input type="number"
                       placeholder="Masukkan harga" 
                       name="price"
                       id="price"
                       class="input input-bordered input-primary w-full max-w-xs
                              @error("price")
                                input-error
                              @enderror"
                       value="{{ old("price", $book->price) }}" />
                @error("price")
                    <small class="text-red-700">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    
            <div class="ml-3 mb-3 flex flex-col">
                <label for="author_id" class="text-lg font-semibold mb-2">Penulis Buku</label>
                <select name="author_id"
                        id="author_id"
                        class="select select-primary w-full max-w-xs 
                               @error("author_id")
                                   select-error
                               @enderror
                            "
                            >
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ $author->id === $book->author_id ? "selected" : "" }}>{{ $author->name }}</option>
                    @endforeach
                </select>
                @error("author_id")
                    <small class="text-red-700">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    
            <div class="ml-3 mb-3 flex flex-col">
                <label for="genre_id" class="text-lg font-semibold mb-2">Genre Buku</label>
                <select name="genre_id[]"
                        id="genre_id"
                        class="select select-primary w-full max-w-xs 
                               @error("genre_id")
                                   select-error
                               @enderror
                            "
                        multiple="multiple"
                        >
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ in_array($genre->id, $book_genre) ? "selected" : "" }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
                @error("genre_id")
                    <small class="text-red-700">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    
            <div class="ml-3 mb-3 flex gap-3">
                <button class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                <a href="{{ route("books.index") }}"><button type="button" class="btn btn-error">Batal</button></a>
            </div>
        </form>
    
        <script>
            // Select2
            $(document).ready(function() {
                $('#genre_id').select2();
                // $('#genre_id').val({{ $book->genre_id }}).trigger("change");
            });
            
            // Preview Image
            function previewImage()
            {
                const image_input = document.querySelector("#image");
                const image_preview = document.querySelector(".image-preview");
    
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image_input.files[0]);
    
                oFReader.onload = function(oFREvent)
                {
                    image_preview.src = oFREvent.target.result;
                }
            }
        </script>
    </div>    
</div>
