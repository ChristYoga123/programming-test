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
        // Get All Book {Default}
        $book_all = Book::with(["Author", "BookGenres.Genre"])->paginate(5);

        // Get Book By Column
        $id = $request->input("id");
        $title = $request->input("title");
        $author = $request->input("author");
        $price_from = $request->input("price_from");
        $price_to = $request->input("price_to");
        $genres = explode("," , $request->input("genres"));

        if($id)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->find($id);
            if($book)
            {
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
            return ResponseFormatter::error("Data tidak ditemukan", Response::HTTP_NOT_FOUND);
            
        }

        if($title)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->where("title", "like" , "%" . $title . "%")->get();
            return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
        }

        if($author)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->whereHas("Author", function($query) use ($author){
                $query->where("name", "like", "%". $author ."%");
            })->get();
            return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
        }

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

        if($genres)
        {
            $book = Book::with(["Author", "BookGenres.Genre"])->whereHas("BookGenres.Genre", function($query) use ($genres){
                $query->whereIn("name", $genres);
            })->get();
            if($book)
            {
                return ResponseFormatter::success($book, "Data berhasil didapat", Response::HTTP_OK);
            }
        }
        return ResponseFormatter::success($book_all, "Data berhasil didapat", Response::HTTP_OK);
    }
}
