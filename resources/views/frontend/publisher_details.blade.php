@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/author_details.css') }}">
@endsection
@section('content')
<!-- Start Header Bottom -->
<section class="bx_header_bottom">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="bx_header_bottom_item bx_header_bottom_categorie">
                    <div class="position-relative">
                        <div class="dropdown" id="bx_book_category_submit">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ $searchs->categorie_name }}</button>
                            <div class=" bx_book_category_item" aria-labelledby="dropdownMenuButton">
                                @foreach ($all_categories as $category)
                                <form action="{{ route('books.category') }}" id="bx_book_category_form" method="GET">
                                    <a class="dropdown-item" data-value="{{ $category->id }}">{{ $category->title }}
                                        <input type="hidden" name="category" value="{{ $category->id }}">
                                    </a>
                                </form>
                                @endforeach
                            </div>
                        </div>

                        <div class="bx_header_bottom_categorie_icon">
                            <i class="{{ $searchs->categorie_icon }}"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-3 pt-md-0">
                <div class="bx_header_bottom_item bx_header_bottom_search position-relative">
                    <form action="{{ route('books.search') }}" class="h-100" method="GET">
                        <div class="input-group">
                            <input type="text" id="bx_book_search_value" class=" form-control bx_font_16_r"
                                placeholder="{{ $searchs->search_placeholder }}" name="term">
                            <div class="input-group-append">
                                <button type="submit" id="bx_book_search_btn" class="input-group-text"><i
                                        class="{{ $searchs->search_icon }}"></i></button>
                            </div>
                        </div>
                    </form>
                    <ul class="bx_search_results" id="bx_search_results" tabindex="0">


                    </ul>
                </div>

            </div>
            <div class="col-12 col-md-4 pt-3 pt-md-0">
                @if (is_object($ads_header))
                <a href="{{ $ads_header->link }}" target="_blank" class="bx_font_16_m">
                    <div class="bx_header_bottom_item bx_header_bottom_blackfriday" style="background: url('{{ asset('images/ads/header/' . $ads_header->image) }}');
                        background-position: center center;
                        background-size: cover;">
                        {{-- {{ $searchs->offer_name }}
                        <span class="bx_font_12_r">{{ $searchs->offer_second_name }}</span> --}}
                    </div>
                </a>
                @endif
            </div>
        </div>
</section>
<!-- End Header Bottom -->
<!-- Start Banner -->
<section class="bx_banner bx_section_p_30 author_details">
    <div class="container p-md-0">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 col-lg-5 mt-3 mt-md-0 pr-md-0">
                <div class="breadcrumb_content">
                    <div class="breadcrumb_title">
                        <h1>Publisher Details</h1>
                    </div>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/') }}">Home</a>
                        <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/book/grid') }}">Books</a>
                        <a class="breadcrumb-item  bx_font_16_r" href="{{ route('books.publishers') }}">Publisehrs</a>
                        <span class="breadcrumb-item bx_font_16_r active">{{ $publisher->name }}</span>
                    </nav>
                </div>

            </div>
            <div class="col-12 col-md-7 col-lg-7 pl-md-0">
                <div class="bx_author_details_info">
                    <div class="row">
                        <div class="col-3">
                            <div class="bx_author_details_img">
                                <img class="img-fluid rounded-circle" alt="{{ $publisher->photo }}"
                                    src="{{ asset('images/publisher/' . $publisher->photo) }}">
                            </div>
                        </div>
                        <div class="col-9">
                            <h4 class="bx_author_details_title bx_font_18_m">{{ $publisher->name }}</h4>
                            <p class="bx_author_details_description bx_font_16_r">
                                {{ $publisher->description }}

                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner -->

<section class="bx_book_sort_menu bx_section_p_30">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12">
                <div
                    class="bx_book_sort_menu_content d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="bx_book_sort_result_heading">
                        <h4 class="bx_book_divider">Show All Results</h4>
                    </div>
                    <div class="bx_book_sort_area d-flex pt-5 pt-md-0">
                        <div class="bx_book_sort_option">
                            <form action="{{ Request::url() }}" method="get" id="bx_book_sort_form_author">
                                <div class="form-group position-relative">
                                    <select class="form-control" name="sort" id="bx_book_sort">
                                        <option value="">Default Sorting</option>
                                        <option value="ID_DESC"
                                            {{ Request::get('sort') ==  'ID_DESC' ? 'selected' : ''}}>New Released
                                        </option>
                                        <option value="PRICE_ASC"
                                            {{ Request::get('sort') ==  'PRICE_ASC' ? 'selected' : ''}}>Price - Low to
                                            High</option>
                                        <option value="PRICE_DESC"
                                            {{ Request::get('sort') ==  'PRICE_DESC' ? 'selected' : ''}}>Price - High to
                                            Low</option>
                                        <option value="DISCOUNT_ASC"
                                            {{ Request::get('sort') ==  'DISCOUNT_ASC' ? 'selected' : ''}}>Discount -
                                            Low to High</option>
                                        <option value="DISCOUNT_DESC"
                                            {{ Request::get('sort') ==  'DISCOUNT_DESC' ? 'selected' : ''}}>Discount -
                                            High to Low</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </form>
                        </div>
                        <div class="bx_book_grid_area d-flex">
                            <span class="bx_book_grid active"><i class="fas fa-th-large"></i></span>
                            <span class="bx_book_list"><i class="fas fa-list"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bx_book_author_details bx_section_p_30 d-none d-md-block">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-5 col-md-9">
                <div class="row">
                    @foreach ($books as $book)
                    <div class="col-md-4 col-lg-3">
                        <div class="bx_author_book_item item">
                            <div class="bx_author_book_wrapper">
                                <a class="bx_author_book_link"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">

                                    <div class="bx_author_book_add_to_cat">
                                        <div class="bx_author_book_image_content">
                                            <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}"
                                                alt="">
                                                @if ($book->discount != null)
                                                <div class="bx_offer_section">
                                                    {{ bx_discount($book->discount) }} 
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="bx_author_book_text_content">
                                        <div class="bx_author_book_title bx_font_18_m">
                                            <h4>{{ $book->title }}</h4>
                                        </div>
                                        <div class="bx_author_book_author bx_font_14_r">
                                            <p>{{ $book->author->name }}</p>
                                        </div>
                                        <div class="bx_author_book_price bx_font_14_r d-flex">
                                            <span
                                                class="bx_author_book_sale_price">{{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100): $book->price) }}</span>
                                            @if ($book->discount != null)
                                            <span class="bx_author_book_org_price pl-4">{{ currency_type($book->price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="bx_author_book_details ">
                                <a class="bx_author_book_btn"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">View
                                    Details</a>
                                <div class="bx_author_book_image_cart">
                                    <button data-id="{{ $book->id }}" class="bx_book_addcart ">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="bx_font_12_r pl-2">Add to cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @php
                $books->appends(Request::all())->links();
                @endphp
                @if ($books->lastPage() > 1)
                <div class="row">
                    <div class="col-12">
                        <div class="bx_book_pagination_content">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if (! $books->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $books->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif
                                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                                        <li class="page-item{{ ($books->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        @if ($books->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                        @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-7 col-md-3">
                <div class="bx_book_sidebar_content d-flex flex-column">
                    <div class="bx_book_sidebar_categories">
                        <div class="bx_book_categories_heading">
                            <a href="{{ url('/book/grid') }}">
                                <h3 class="bx_book_divider">All Categories</h3>
                            </a>
                        </div>
                        <div class="bx_book_categories_list">
                            <ul class="bx_book_main_categories bx_font_14_r">
                                @foreach ($categories as $category)
                                <li>
                                    <span class="d-flex justify-content-between">
                                        <span class="bx_book_main"> {{  $category->title}} </span><span>
                                            ({{ DB::table('books')->join('book_sub_category', function ($book){
                                                    $book->on('books.id', 'book_sub_category.book_id')->where('status', 1);
                                                })
                                                ->join('sub_categories', function ($sub){
                                                    $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
                                                })
                                                ->join('categories', function ($cat){
                                                    $cat->on('sub_categories.category_id', 'categories.id');
                                                })
                                                ->where('categories.id', $category->id)
                                                ->distinct()
                                                ->count() }})
                                        </span>
                                    </span>
                                    <ul class="bx_book_sub_categories">
                                        @foreach ($category->subcategory as $subcategory)
                                        <li>
                                            <a href="{{ url('/book/grid?category='.$subcategory->id) }}"
                                                class="d-flex justify-content-between">
                                                <span>{{ $subcategory->title }}</span><span
                                                    class="bx_book_sub_books">({{ $subcategory->books()->where('status', 1)->count() }})</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="bx_book_sidebar_filter">
                        <div class="bx_book_filter_heading text-left text-md-center">
                            <h4 class="bx_book_divider">Filter By Price</h4>
                        </div>
                        <div class="bx_book_filter_range">
                            <div id="slider-range"></div>
                            <form action="{{ Request::url() }}" method="GET" id="bx_book_price_range">
                                <input type="hidden" name="min_value" value="" id="bx_book_min">
                                <input type="hidden" name="max_value" value="" id="bx_book_max">
                            </form>
                            <div class="bx_book_filter_price_btn d-flex justify-content-between align-items-center">
                                <div class="bx_book_filter_price slider-labels">
                                    <span>
                                        Price: <span id="slider-range-value1" class="bx_book_filter_low"></span> -
                                        <span id="slider-range-value2" class="bx_book_filter_high"></span>
                                    </span>
                                </div>
                                <div class="bx_book_filter_btn">
                                    <button type="button" name="" id="bx_book_filter_price"
                                        class="btn bx_btn">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bx_book_sidebar_recent_products">
                        <div class="bx_book_recent_heading">
                            <h5 class="bx_book_divider">Update books</h5>
                        </div>
                        <div class="bx_book_recent_content">
                            <ul class="list-unstyled">
                                @foreach (DB::table('books')->orderBy('id', 'desc')->where('status', 1)->limit(3)->get()
                                as $recent_book)
                                <li class="media">
                                    <a class="d-flex"
                                        href="{{ url('book/'.$recent_book->id .'/'.strtolower(str_replace(" ", "-", $recent_book->title))) }}">
                                        <img src="{{ asset('images/book/'. $recent_book->photo) }}"
                                            alt="{{ $recent_book->photo }}">
                                    </a>
                                    <div class="media-body">
                                        <div class="bx_book_text">
                                            <p class="bx_font_14_r">{{ $recent_book->title }}</p>
                                            <span>{{ currency_type($recent_book->discount != null ? ($recent_book->price - ($recent_book->price * $recent_book->discount) / 100) : $recent_book->price)  }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="bx_book_author_details bx_section_p_30 d-md-none pb-0">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-5 col-md-9">
                <div class="row">
                    @foreach ($books as $key => $book)
                    @if ($key == 4)
                        @php
                            break;
                        @endphp
                    @endif
                    <div class="col-md-4 col-lg-3">
                        <div class="bx_author_book_item item">
                            <div class="bx_author_book_wrapper">
                                <a class="bx_author_book_link"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">

                                    <div class="bx_author_book_add_to_cat">
                                        <div class="bx_author_book_image_content">
                                            <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}"
                                                alt="">
                                                @if ($book->discount != null)
                                                <div class="bx_offer_section">
                                                    {{ bx_discount($book->discount) }} 
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="bx_author_book_text_content">
                                        <div class="bx_author_book_title bx_font_18_m">
                                            <h4>{{ $book->title }}</h4>
                                        </div>
                                        <div class="bx_author_book_author bx_font_14_r">
                                            <p>{{ $book->author->name }}</p>
                                        </div>
                                        <div class="bx_author_book_price bx_font_14_r d-flex">
                                            <span
                                                class="bx_author_book_sale_price">{{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100): $book->price) }}</span>
                                            @if ($book->discount != null)
                                            <span class="bx_author_book_org_price pl-4">{{ currency_type($book->price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="bx_author_book_details ">
                                <a class="bx_author_book_btn"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">View
                                    Details</a>
                                <div class="bx_author_book_image_cart">
                                    <button data-id="{{ $book->id }}" class="bx_book_addcart ">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="bx_font_12_r pl-2">Add to cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-7 col-md-3">
                <div class="bx_book_sidebar_content d-flex flex-column">
                    <div class="bx_book_sidebar_categories">
                        <div class="bx_book_categories_heading">
                            <a href="{{ url('/book/grid') }}">
                                <h3 class="bx_book_divider">All Categories</h3>
                            </a>
                        </div>
                        <div class="bx_book_categories_list">
                            <ul class="bx_book_main_categories bx_font_14_r">
                                @foreach ($categories as $category)
                                <li>
                                    <span class="d-flex justify-content-between">
                                        <span class="bx_book_main"> {{  $category->title}} </span><span>
                                            ({{ DB::table('books')->join('book_sub_category', function ($book){
                                                    $book->on('books.id', 'book_sub_category.book_id')->where('status', 1);
                                                })
                                                ->join('sub_categories', function ($sub){
                                                    $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
                                                })
                                                ->join('categories', function ($cat){
                                                    $cat->on('sub_categories.category_id', 'categories.id');
                                                })
                                                ->where('categories.id', $category->id)
                                                ->distinct()
                                                ->count() }})
                                        </span>
                                    </span>
                                    <ul class="bx_book_sub_categories">
                                        @foreach ($category->subcategory as $subcategory)
                                        <li>
                                            <a href="{{ url('/book/grid?category='.$subcategory->id) }}"
                                                class="d-flex justify-content-between">
                                                <span>{{ $subcategory->title }}</span><span
                                                    class="bx_book_sub_books">({{ $subcategory->books()->where('status', 1)->count() }})</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="bx_book_sidebar_filter">
                        <div class="bx_book_filter_heading text-left text-md-center">
                            <h4 class="bx_book_divider">Filter By Price</h4>
                        </div>
                        <div class="bx_book_filter_range">
                            <div id="slider-range"></div>
                            <form action="{{ Request::url() }}" method="GET" id="bx_book_price_range">
                                <input type="hidden" name="min_value" value="" id="bx_book_min">
                                <input type="hidden" name="max_value" value="" id="bx_book_max">
                            </form>
                            <div class="bx_book_filter_price_btn d-flex justify-content-between align-items-center">
                                <div class="bx_book_filter_price slider-labels">
                                    <span>
                                        Price: <span id="slider-range-value1" class="bx_book_filter_low"></span> -
                                        <span id="slider-range-value2" class="bx_book_filter_high"></span>
                                    </span>
                                </div>
                                <div class="bx_book_filter_btn">
                                    <button type="button" name="" id="bx_book_filter_price"
                                        class="btn bx_btn">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bx_book_sidebar_recent_products">
                        <div class="bx_book_recent_heading">
                            <h5 class="bx_book_divider">Update books</h5>
                        </div>
                        <div class="bx_book_recent_content">
                            <ul class="list-unstyled">
                                @foreach (DB::table('books')->orderBy('id', 'desc')->where('status', 1)->limit(3)->get()
                                as $recent_book)
                                <li class="media flex-column flex-md-row">
                                    <a class="d-flex"
                                        href="{{ url('book/'.$recent_book->id .'/'.strtolower(str_replace(" ", "-", $recent_book->title))) }}">
                                        <img src="{{ asset('images/book/'. $recent_book->photo) }}"
                                            alt="{{ $recent_book->photo }}">
                                    </a>
                                    <div class="media-body">
                                        <div class="bx_book_text">
                                            <p class="bx_font_14_r">{{ $recent_book->title }}</p>
                                            <span>{{ currency_type($recent_book->discount != null ? ($recent_book->price - ($recent_book->price * $recent_book->discount) / 100) : $recent_book->price)  }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="bx_book_author_details bx_section_p_30 d-md-none pt-0">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @foreach ($books as $key =>  $book)
                    @if ($key > 4)  
                    <div class="col-6">
                        <div class="bx_author_book_item item">
                            <div class="bx_author_book_wrapper">
                                <a class="bx_author_book_link"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">

                                    <div class="bx_author_book_add_to_cat">
                                        <div class="bx_author_book_image_content">
                                            <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}"
                                                alt="">
                                                @if ($book->discount != null)
                                                <div class="bx_offer_section">
                                                    {{ bx_discount($book->discount) }} 
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="bx_author_book_text_content">
                                        <div class="bx_author_book_title bx_font_18_m">
                                            <h4>{{ $book->title }}</h4>
                                        </div>
                                        <div class="bx_author_book_author bx_font_14_r">
                                            <p>{{ $book->author->name }}</p>
                                        </div>
                                        <div class="bx_author_book_price bx_font_14_r d-flex">
                                            <span
                                                class="bx_author_book_sale_price">{{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100): $book->price) }}</span>
                                            @if ($book->discount != null)
                                            <span class="bx_author_book_org_price pl-4">{{ currency_type($book->price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="bx_author_book_details ">
                                <a class="bx_author_book_btn"
                                    href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                    target="_blank">View
                                    Details</a>
                                <div class="bx_author_book_image_cart">
                                    <button data-id="{{ $book->id }}" class="bx_book_addcart ">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="bx_font_12_r pl-2">Add to cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                @php
                $books->appends(Request::all())->links();
                @endphp
                @if ($books->lastPage() > 1)
                <div class="row">
                    <div class="col-12">
                        <div class="bx_book_pagination_content">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if (! $books->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $books->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif
                                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                                        <li class="page-item{{ ($books->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        @if ($books->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                        @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
</section>

@endsection
@section('scripts')
<script src="{{ asset('js/range.js') }}"></script>
<script>
    (function ($) {
        "use strict";
         $("#bx_book_sort").on("change",function(){
            if(this.value != null) {
                $('#bx_book_sort_form_author').submit();
            }
        });

        $("#bx_book_filter_price").on("click",function(){
            event.preventDefault();
            $('#bx_book_price_range').submit();
        });


      var maxLength = 200;

        $(".bx_author_details_description").each(function(){

            var myStr = $(this).text();

            if($.trim(myStr).length > maxLength){

                var newStr = myStr.substring(0, maxLength);

                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);

                $(this).empty().html(newStr);

                $(this).append('<span class="bx_author_details_read_btn bx_font_18_m read-more">Read More</span>');

                $(this).append('<span class="bx_read_more_text">' + removedStr + '</span>');
            }

        });

        $(".bx_author_details_read_btn").click(function(){

            $(this).siblings(".bx_read_more_text").contents().unwrap();

            $(this).remove();

        });
    })(jQuery);
</script>
@endsection
