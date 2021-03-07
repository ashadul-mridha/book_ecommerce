<?php

namespace App\Http\Controllers\Backend\Book;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = SubCategory::all();
        $books = Book::orderBy('id', 'asc')->get();
        return view('backend.books.index', compact('books', 'cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $publishers = Publisher::orderBy('id', 'desc')->get();
        return view('backend.books.create', compact('categories', 'authors', 'publishers'));
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
            'title' => 'required',
            'author_id' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'edition' => 'required',
            'language' => 'required',
        ]);
        if ($request->discount) {
            $request->validate([
                'discount' => 'numeric|between:1,100',
            ]);
        }
        $user_id = Auth::user()->id;
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $best_sale = 0;
        if ($request->best_sale) :
            $best_sale = 1;
        endif;

        $book = new Book();
        $book->isbn = $request->isbn;
        $book->user_id = $user_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->search_title = $request->search_title;
        $book->price = $request->price;
        $book->discount = $request->discount;
        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->edition = $request->edition;
        $book->language = $request->language;
        $book->status = $status;
        $book->best_sale = $best_sale;
        $book->save();

        $book_id = $book->id;
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:10240|mimes:jpeg,jpg,png',
            ]);
            $photo_name = $ran_name . '_' . $book_id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(190, 270)->save(base_path('public/images/book/' . $photo_name), 100);
            $book = Book::find($book_id);
            $book->photo = $photo_name;
            $book->save();
        }
        $book->subcategories()->attach($request->category);
        return redirect()->route('admin.books.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('backend.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $publishers = Publisher::orderBy('id', 'desc')->get();
        $book = Book::findOrFail($id);
        return view('backend.books.edit', compact('book', 'categories', 'authors', 'publishers'));
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
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'edition' => 'required',
            'language' => 'required',
        ]);
        if ($request->discount) {
            $request->validate([
                'discount' => 'numeric|between:1,100',
            ]);
        }
        $user_id = Auth::user()->id;
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $best_sale = 0;
        if ($request->best_sale) :
            $best_sale = 1;
        endif;
        $book =  Book::findOrFail($id);
        $book->isbn = $request->isbn;
        $book->user_id = $user_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->search_title = $request->search_title;
        $book->price = $request->price;
        $book->discount = $request->discount;
        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->edition = $request->edition;
        $book->language = $request->language;
        $book->status = $status;
        $book->best_sale = $best_sale;
        $book->save();

        if ($request->hasFile('photo')) {
            $ran_name = strtolower(Str::random(11));
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:10240|mimes:jpeg,jpg,png',
            ]);
            if (Book::findOrFail($id)->photo != 'book.png') {
                $link = base_path('public/images/book/' . Book::findOrFail($id)->photo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $photo_name = $ran_name . '_' . $id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(190, 270)->save(base_path('public/images/book/' . $photo_name), 100);
            $book = Book::findOrFail($id);
            $book->photo = $photo_name;
            $book->save();
        }
        $book->subcategories()->sync($request->category);
        return redirect()->route('admin.books.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Book::findOrFail($id);
        $destroy->delete();
        $destroy->subcategories()->detach();
        if ($destroy->photo != 'book.png') {
            $link = base_path('public/images/book/' . $destroy->photo);
            if (file_exists($link)) {
                unlink($link);
            }
        }
        return redirect()->route('admin.books.index')->with('success', 'Data is successfully deleted');
    }
}
