<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {

        $book = Book::create($this->validateRequest());
        return redirect($book->path());

    }

    public function update(Book $book)
    {
        $book->update($this->validateRequest());
        return redirect($book->path());
    }

    /**
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }

    public function delete(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/book');
    }
}
