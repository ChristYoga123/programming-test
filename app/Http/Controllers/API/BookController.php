<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Formatter\ResponseFormatterController as ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Book;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Get All Data
        $book_all = Book::with(["Author", "BookGenres.Genre"])->paginate(5);

        // Get By Column
        $id = $request->input("id");
        $title = $request->input("title");
        $author = $request->input("author");
        $price_from = $request->input("price_from");
        $price_to = $request->input("price_to");
        $genre = $request->input("genres");
        $genres = explode("," , $genre);

        // By Id
        if($id)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->find($id);
            if($book)
            {
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
            return ResponseFormatter::error("Data tidak ditemukan", Response::HTTP_NOT_FOUND);
            
        }

        // By Title
        if($title)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->where("title", "like" , "%" . $title . "%")->get();
            return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
        }

        // By Author
        if($author)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->whereHas("Author", function($query) use ($author){
                $query->where("name", "like", "%". $author ."%");
            })->get();
            return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
        }

        // By Price
        if($price_from)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->where("price", ">=" , $price_from)->get();
            if($book)
            {
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
            return ResponseFormatter::error("Data tidak ditemukan", Response::HTTP_NOT_FOUND);
        }

        if($price_to)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->where("price", "<=" , $price_to)->get();
            if($book)
            {
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
            return ResponseFormatter::error("Data tidak ditemukan", Response::HTTP_NOT_FOUND);
        }

        // By Genres
        if($genre)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->whereHas("BookGenres.Genre", function($query) use ($genres){
                $query->whereIn("name", $genres);
            })->get();
            if(count($book) > 0){
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
            return ResponseFormatter::error("Tidak ada Data berdasarkan Genre yang dicari", Response::HTTP_NOT_FOUND);
        }

        // Default Return All
        return ResponseFormatter::success($book_all, "Data berhasil didapat", Response::HTTP_OK);
    }
}
