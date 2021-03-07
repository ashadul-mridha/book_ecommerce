<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Search;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        $publishers = Publisher::orderBy('id', 'asc');
        $publishersearch = $request->publishersearch;
        if ($publishersearch != '') {
            $publishers = Publisher::where('name', 'like',  '%' . $publishersearch . '%');
            if (!$publishers) {
                return abort(404);
            }
        }
        $publishers = $publishers->paginate(50);
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != "") {
                $data = Publisher::where('name', 'like',  '%' . $query . '%')->get();
            }
            $publisher_view = '';
            if ($data->count() > 0) {
                foreach ($data as $author) {
                    $publisher_view .= '
                        <li >
                            <a href="/book/publisher/' . $author->id . '/details" class="bx_book_wrapper d-flex align-items-center">
                                <div>
                                    <img width="80px" class="rounded-circle" src="/images/publisher/' . $author->photo . '" alt="' . $author->photo . '" >
                                </div>
                                <div class="bx_book_info pl-4">
                                    <p class="author_name bx_font_16_r">' . $author->name . '</p>
                                </div>
                            </a>
                        </li>
               ';
                }
            } else {
                $publisher_view = 'No Publisher Found';
            }
            return $publisher_view;
        }
        return view('frontend.publisher', compact('publishers', 'categories', 'searchs', 'all_categories'));
    }
    public function publisher_details(Request $request, $id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return abort(404);
        }
        $books = $publisher->books()->where('status', 1);
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
        return view('frontend.publisher_details', compact('publisher', 'books', 'categories', 'searchs', 'all_categories'));
    }
}
