<?php

namespace App\Http\Requests\Book;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => ["required", "max:255", "unique:books,id"],
            "image" => ["required", "image", "mimes:png,jpg,jpeg", "max:1024"],
            "price" => ["required", "integer", "min:1"],
            "author_id" => ["required", "integer", "exists:authors,id"],
            "genre_id" => ["required", "array"],
            "genre_id.*" => ["integer", "exists:genres,id"]
        ];
    }
}
