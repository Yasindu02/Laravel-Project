<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function add()
    {
        return view('bookdetails.addbook');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $existingBook = Book::where('title', $request->input('title'))
        ->where('author', $request->input('author'))
        ->first();

        if ($existingBook) {
            return back()->with('error', 'Book with the same title and author already exists');
        }
    
        $book = Book::create($request->all());
    
        if ($book) {
            return back()->with("success", "Book Added Successfully");
        } else {
            return back()->with("failed", "Failed to add book");
        }
    }
    

    public function index()
    {
        $books = Book::all();
        return view('bookdetails.index')->with('books', $books);
    }

    public function bookDestroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('bookdetails.index')->with('success','Book Deleted Succesfuly');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('bookdetails.editbook', ['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::find($id);

        if ($book)
         {
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->price = $request->input('price');
            $book->stock = $request->input('stock');
            $book->save();
            return back()->with("success", "Book Updated Successfully");
        } 
        else 
        {
            return back()->with("error", "Book Not Found");
        }
    }
}
