<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Library;
use App\Models\LibraryBook;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->with('author', 'library')->paginate();
        return view('book.index', compact('books'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::get();
        $libraries = Library::get();
        return view('book.create', compact('authors', 'libraries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'author' => 'required'
        ]);
        $data = $request->all();
        $name = $data['name'];
        $year = $data['year'];
        $author_id = $data['author'];
        $library_id = $data['library'];

        $book = new Book();
        $book->name = $name;
        $book->year = $year;
        $book->author_id = $author_id;
        $book->save();

        $book_id = $book->id;

        if($library_id != null) {
            $pivot = new LibraryBook();
            $pivot->book_id = $book_id;
            $pivot->library_id = $library_id;
            $pivot->save();
        }

        return redirect()->route('books.index')->with('success','book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::where('id', $id)->with('author', 'library')->get();
        $authors = Author::get();
        $libraries = Library::get();
        return view('book.edit',compact('book', 'authors', 'libraries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $name = $data['name'];
        $year = $data['year'];
        $author_id = $data['author'];
        $library_id = $data['library'];

        Book::where('id', $id)->update( [
            'name' => $name,
            'year' => $year,
            'author_id' => $author_id
        ]);

        $already_book = LibraryBook::where('book_id', $id)->get();
        if($already_book->count() != 0) {
            LibraryBook::where('book_id', $id)->update([
                'book_id' => $id,
                'library_id' => $library_id
            ]);
        }else {
            LibraryBook::create([
                'book_id' => $id,
                'library_id' => $library_id
            ]);
        }
        return redirect()->route('books.index')->with('success','book Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('id', $id)->delete();
        return redirect()->route('books.index')->with('success','book deleted successfully.');

    }
}
