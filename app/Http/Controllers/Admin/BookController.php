<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublishersFormRequest;
use App\Http\Requests\Admin\BooksFormRequest;
use App\Models\Authors;
use App\Models\Categories;
use App\Models\piece;
use App\Models\PieceDetail;
use App\Models\Books;
use App\Models\Publishers;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $authors = Authors::all();
        $publishers = Publishers::all();
        $books = Books::all();
        return view('adminpanel.adminviews.Books.index',
            compact('publishers','authors','categories','books'));
    }

    public function create()
    {
        $categories = Categories::all();
        $authors = Authors::all();
        $publishers = Publishers::all();

        return view('adminpanel.adminviews.Books.create',
            compact('authors','categories','publishers'));
    }

    public function store(BooksFormRequest $request)
    {
        $data = $request->validated();
        $book = new Books;

        $book->name = $data['name'];
        $book->price = $data['price'];
        $book->stock = $data['stock'];

        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $book->image = $filename;
        }

        $book->CategoryID = $data['CategoryID'];
        $book->AuthorID = $data['AuthorID'];
        $book->PublisherID = $data['PublisherID'];
        $book->description = $request['description'];
        $book->save();

        return redirect()->route('Books')->with('message', 'Book Added Successfully');
    }

    public function edit($book_id)
    {
        $book = Books::find($book_id);
        $authors = Authors::all();
        $categories = Categories::all();
        $publishers = Publishers::all();

        return view('adminpanel.adminviews.Books.edit',
            compact('book','authors','categories','publishers'));
    }

    public function update(BooksFormRequest $request, $book_id)
    {
        $data = $request->validated();
        $book = Books::find($book_id);
        $book->name = $data['name'];

        if ($request->has('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $book->image = $filename;
        }

        $book->price = $data['price'];
        $book->stock = $data['stock'];
        $book->description = $request['description'];
        $book->CategoryID = $data['CategoryID'];
        $book->AuthorID = $data['AuthorID'];
        $book->PublisherID = $data['PublisherID'];
        $book->update();

        return redirect()->route('Books')->with('message', 'Book Update Successfully');
    }

    public function delete($book_id)
    {
        $book = Books::find($book_id);
        if ($book)
        {
            $book->delete();
            return redirect(route('Books'))->with('message','Book Delete Successfully');
        }
        else
        {
            return redirect(route('Books'))->with('message','No Book ID Found');
        }
    }
}

