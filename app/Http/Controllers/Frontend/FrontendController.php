<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Search;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\HomePageCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdsBanner;
use App\Models\AdsBottom;
use App\Models\Page;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function seed()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        // Artisan::call('migrate');
        // Artisan::call('migrate:fresh');
        // Artisan::call('db:seed');
        return 'done';
    }
    public function index()
    {

        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        $home_page_category = HomePageCategory::orderBy('id', 'asc')->where('status', 1)->get('category_id')->toArray();

        $ads_banner = AdsBanner::orderBy('id', 'desc')->limit(1)->first();
        $ads_bottom = AdsBottom::orderBy('id', 'desc')->limit(1)->first();

        return view('frontend.index', compact('home_page_category', 'searchs', 'all_categories', 'ads_banner', 'ads_bottom'));
    }

    // code for ajax live search
    public function live_search(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            if ($query != "") {
                $books = BooK::where('title', 'like',  '%' . $query . '%')
                    ->orWhere('search_title', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->where('status', 1)->get();
            }
            $book_view = '';
            if ($books->count() > 0) {
                foreach ($books as $book) {
                    $book_view .= '
                        <li>
                            <a href="/book/' . $book->id . '/' . strtolower(str_replace(" ", "-", $book->title)) . '" class="bx_book_wrapper d-flex align-items-center">
                             
                                <div class="bx_book_info">
                                    <p class="title">' . $book->title . '</p>
                                    <p class="author" style="font-size:10px;">' . $book->author->name . '</p>
                                </div>
                                <div class="bx_book_price ml-auto">
                                    <p>';
                    if ($book->discount != null) {
                        $book_view .= '<span class="pr-1">(-' . $book->discount . '%)</span>';
                    }

                    $book_view .= '' . currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price) . '
                                    </p>
                                </div>
                            </a>
                        </li>
               ';
                }
            } else {
                $book_view = 'No Book Found';
            }
            return $book_view;
        } else {
            return redirect('/');
        }
    }
    // code for search page
    public function search(Request $request)
    {
        if ($request->get('term')) {
            $query = $request->get('term');
            if ($query != "") {
                $books = BooK::where('title', 'like',  '%' . $query . '%')
                    ->orWhere('search_title', 'like', '%' . $query . '%')
                    ->where('status', 1);
            } else {
                return redirect()->back();
            }

            if ($books->count() > 0) {
                $all_books = $books;
            } else {
                return abort(404);
            }

            $all_categories = Category::orderBy('id', 'desc')->get();
            $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
            $categories = Category::orderBy('id', 'desc')->get();
        } else {
            return redirect('/');
        }
        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $all_books = $all_books->orderBy('id', 'desc')->paginate(24);
            } elseif ($sort == 'PRICE_ASC') {
                $all_books = $all_books->orderBy('price', 'asc')->paginate(24);
            } elseif ($sort == 'PRICE_DESC') {
                $all_books = $all_books->orderBy('price', 'desc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_ASC') {
                $all_books = $all_books->orderBy('discount', 'asc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_DESC') {
                $all_books = $all_books->orderBy('discount', 'desc')->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $all_books =  $all_books->where('price', '>=', $request->min_value)
                    ->where('price', '<=', $request->max_value)->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        }


        return view('frontend.search', compact('all_books', 'categories', 'searchs', 'all_categories'));
    }
    // code for search page
    public function category_page(Request $request)
    {
        if ($request->category) {
            $id  = $request->get('category');
            $sub = $request->get('sub');
            $category = Category::find($id);
            if (!$category) {
                return redirect()->back();
            } else {
                if ($request->sub) {
                    if (SubCategory::where('id', $sub)->exists()) {
                        $sub_cat = SubCategory::where('id', $sub)->first();
                        $all_books = $sub_cat->books()->where('status', 1);
                    } else {
                        return redirect('/category?category=' . $id);
                    }
                } else {
                    $all_books =   DB::table('books')
                        ->join('book_sub_category', function ($book) {
                            $book->on('books.id', 'book_sub_category.book_id');
                        })
                        ->join('sub_categories', function ($sub) {
                            $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
                        })
                        ->join('categories', function ($cat) {
                            $cat->on('sub_categories.category_id', 'categories.id');
                        })->select('books.*')
                        ->where('categories.id', $id)
                        ->distinct();
                }
            }
        } else {
            return redirect('/');
        }
        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $all_books = $all_books->orderBy('id', 'desc')->paginate(24);
            } elseif ($sort == 'PRICE_ASC') {
                $all_books = $all_books->orderBy('price', 'asc')->paginate(24);
            } elseif ($sort == 'PRICE_DESC') {
                $all_books = $all_books->orderBy('price', 'desc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_ASC') {
                $all_books = $all_books->orderBy('discount', 'asc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_DESC') {
                $all_books = $all_books->orderBy('discount', 'desc')->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $all_books =  $all_books->where('price', '>=', $request->min_value)
                    ->where('price', '<=', $request->max_value)->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        }

        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        return view('frontend.category', compact('all_books', 'categories', 'searchs', 'all_categories'));
    }
    public function book_details($id, $name)
    {
       
        if (!Book::find($id)) :
            return redirect()->back();
        endif;
        $name = str_replace('-', ' ', $name);
        $book = Book::where('id', $id)->where('title', 'like', '%' . $name . '%')->first();
        $book_view = 'book_' . $id;
        if (!Session::has($book_view)) {
            $book = Book::find($id);
            $book->increment('view_count');
            Session::put($book_view, 1);
        }
        $sub_cat_id =  $book->subcategories->first()->category_id;
        $related_books = Category::with(['subcategory', 'subcategory.books' => function ($query) {
            $query->where('status', 1);
        }])->where('id', $sub_cat_id)->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();

        // $home_page_item = DB::table('books')
        //     ->join('book_sub_category', function ($book) {
        //     $book->on('books.id', 'book_sub_category.book_id')->where('status', 1);
        //     })
        //     ->join('sub_categories', function ($sub) {
        //     $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
        //     })
        //     ->join('categories', function ($cat) {
        //     $cat->on('sub_categories.category_id', 'categories.id');
        //     })->select('categories.title')->orderBy('id', 'asc')
        //     ->where('books.id', $id)->distinct()
        //     ->get();

         
        $category = DB::table('books')
                ->join('book_sub_category','book_sub_category.book_id','books.id')
                ->join('sub_categories','sub_categories.id','book_sub_category.sub_category_id')
                ->join('categories','categories.id','sub_categories.category_id')
                ->where('books.id',$id)
                ->select('categories.*')
                ->get();
              //  dd($category);
        return view('frontend.details', compact('book', 'related_books','searchs','all_categories','category'));
    }
    public function book_grid(Request $request)
    {
        $all_categories = Category::orderBy('id', 'desc')->get();
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $categories = Category::orderBy('id', 'desc')->get();
        $get_category =  $request->get("category");
        if ($get_category) {
            if (SubCategory::where('id', $get_category)->exists()) {
                $category = SubCategory::where('id', $get_category)->first();
                $all_books = $category->books()->where('status', 1);
            } else {
                return redirect('/book/grid');
            }
        } else {
            $all_books = Book::where('status', 1);
        }

        $sort = $request->sort;
        if ($sort) {
            if ($sort == 'ID_DESC') {
                $all_books = $all_books->orderBy('id', 'desc')->paginate(24);
            } elseif ($sort == 'PRICE_ASC') {
                $all_books = $all_books->orderBy('price', 'asc')->paginate(24);
            } elseif ($sort == 'PRICE_DESC') {
                $all_books = $all_books->orderBy('price', 'desc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_ASC') {
                $all_books = $all_books->orderBy('discount', 'asc')->paginate(24);
            } elseif ($sort == 'DISCOUNT_DESC') {
                $all_books = $all_books->orderBy('discount', 'desc')->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        } else {
            if ($request->min_value && $request->max_value) {
                $all_books =  $all_books->where('price', '>=', $request->min_value)
                    ->where('price', '<=', $request->max_value)->paginate(24);
            } else {
                $all_books = $all_books->orderBy('id', 'asc')->paginate(24);
            }
        }
        return view('frontend.grid', compact('all_books', 'categories', 'searchs', 'all_categories'));
    }
    /**
     * get page by slug
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 1)->first();
        if (!$page) {
            return back();
        }
        return view('frontend.page', compact('page'));
    }
}
