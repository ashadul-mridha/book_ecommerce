<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Search;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BoimelaCategory;
use App\Models\Book;

class BoimelaController extends Controller
{
    public function index(Request $request)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        $boimela_cat = BoimelaCategory::where('status', 1)->orderBy('id', 'desc')->limit(1)->first();
        if (!$boimela_cat) {
            return redirect('/');
        }
        $category_id = $boimela_cat->category_id;
        $boimela = Category::with(['subcategory.books' => function ($query) {
            $query->where('status', 1)->orderBy('id', 'asc');
        }])->where('id', $category_id)->get()->groupBy('id');

        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('id', 'desc');
                }])->where('id', $category_id)->get()->groupBy('id');
            } elseif ($sort == 'PRICE_ASC') {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('price', 'asc');
                }])->where('id', $category_id)->get()->groupBy('id');
            } elseif ($sort == 'PRICE_DESC') {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('price', 'desc');
                }])->where('id', $category_id)->get()->groupBy('id');
            } elseif ($sort == 'DISCOUNT_ASC') {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('discount', 'asc');
                }])->where('id', $category_id)->get()->groupBy('id');
            } elseif ($sort == 'DISCOUNT_DESC') {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('discount', 'desc');
                }])->where('id', $category_id)->get()->groupBy('id');
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $boimela = Category::with(['subcategory.books' => function ($query) use ($request) {
                    $query->where('status', 1)->where('price', '>=', $request->min_value)
                        ->where('price', '<=', $request->max_value);
                }])->where('id', $category_id)->get()->groupBy('id');
            } else {
                $boimela = Category::with(['subcategory.books' => function ($query) {
                    $query->where('status', 1)->orderBy('id', 'asc');
                }])->where('id', $category_id)->get()->groupBy('id');
            }
        }

        return view('frontend.boimela', compact('boimela', 'categories', 'searchs', 'all_categories'));
    }
    // for best seller page
    public function best_saller(Request $request)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();

        $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('id', 'asc')->get();

        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('id', 'desc')->get();
            } elseif ($sort == 'PRICE_ASC') {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('price', 'asc')->get();
            } elseif ($sort == 'PRICE_DESC') {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('price', 'desc')->get();
            } elseif ($sort == 'DISCOUNT_ASC') {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('discount', 'asc')->get();
            } elseif ($sort == 'DISCOUNT_DESC') {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('discount', 'desc')->get();
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->where('price', '>=', $request->min_value)
                    ->where('price', '<=', $request->max_value)->get();
            } else {
                $best_seller = Book::where('best_sale', 1)->where('status', 1)->orderBy('id', 'asc')->get();
            }
        }

        return view('frontend.best_seller', compact('best_seller',  'searchs', 'all_categories'));
    }
}
