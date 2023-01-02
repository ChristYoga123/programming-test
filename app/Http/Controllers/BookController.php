<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Models\BookGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $data = $request->except("genre_id");

        // Handling Slug & Image
        $data["slug"] = Str::slug($data["title"]);
        $data["image"] = $request->file("image")->store("book/img", "public");

        $new_book = Book::create($data);
        foreach($request->genre_id as $genre)
        {
            $book_genre[] = new BookGenre([
                    "book_id" => $new_book->id,
                    "genre_id" => $genre
            ]);
        }

        $new_book->BookGenres()->saveMany($book_genre);
        return redirect()->route("books.index")->with("success", "Data berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit')->with([
            "book" => $book    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->except("genre_id");

        // Handling Slug & Image
        $data["slug"] = Str::slug($data["title"]);

        if($request->file("image"))
        {
            if($request->old_image)
            {
                Storage::delete($request->old_image);
            }
            $data["image"] = $request->file("image")->store("book/img", "public");
        }

        $book->update($data);
        foreach($request->genre_id as $genre)
        {
            $book_genre[] = new BookGenre([
                    "book_id" => $book->id,
                    "genre_id" => $genre
            ]);
        }
        $book->BookGenres()->delete();
        $book->BookGenres()->saveMany($book_genre);
        return redirect()->route("books.index")->with("success", "Data berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        BookGenre::where('book_id', $book->id)->delete();
        Storage::delete($book->image);
        $book->delete();

        return redirect()->route("books.index")->with("success", "Data berhasil dihapus");
    }
}
