<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Author;
use App\Models\Search;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'asc');
        $authorsearch = $request->authorsearch;
        if ($authorsearch != '') {
            $authors = Author::where('name', 'like',  '%' . $authorsearch . '%');
        } else {
            $authors = $authors;
        }
        $authors = $authors->paginate(50);
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != "") {
                $data = Author::where('name', 'like',  '%' . $query . '%')->get();
            }
            $author_view = '';
            if ($data->count() > 0) {
                foreach ($data as $author) {
                    $author_view .= '
                        <li >
                            <a href="/book/author/' . $author->id . '/details" class="bx_book_wrapper d-flex align-items-center">
                                <div>
                                    <img width="80px" class="rounded-circle" src="/images/author/' . $author->photo . '" alt="' . $author->photo . '" >
                                </div>
                                <div class="bx_book_info pl-4">
                                    <p class="author_name bx_font_16_r">' . $author->name . '</p>
                                </div>
                            </a>
                        </li>
               ';
                }
            } else {
                $author_view = 'No Author Found';
            }
            return $author_view;
        }
        return view('frontend.author', compact('authors', 'categories', 'searchs', 'all_categories'));
    }
    public function author_details(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            return abort(404);
        }
        $books = $author->books()->where('status', 1);
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $books = $books->orderBy('id', 'desc')->paginate(24);
            } elseif ($sort == 'PRICE_ASC') {
                $books = $books->orderBy('price', 'asc')->paginate(24);
            } elseif ($sort == 'PRICE_DESC') {
                $books = $books->orderBy('price', 'desc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_ASC') {
                $books = $books->orderBy('discount', 'asc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_DESC') {
                $books = $books->orderBy('discount', 'desc')->paginate(24);
            } else {
                $books = $books->orderBy('id', 'asc')->paginate(24);
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $books =  $books->where('price', '>=', $request->min_value)
                    ->where('price', '<=', $request->max_value)->paginate(24);
            } else {
                $books = $books->orderBy('id', 'asc')->paginate(24);
            }
        }

        return view('frontend.author_details', compact('author', 'books', 'categories', 'searchs', 'all_categories'));
    }
}
