<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class Buku1Controller extends Controller
{
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $book->benefits = json_decode($book->benefits); 

        return view('buku.show', compact('book'));
    }
}
