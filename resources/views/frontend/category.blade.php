@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/book_grid.css') }}">
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
<section class="bx_banner bx_section_p_30">
    <div class="container p-md-0">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="bx_banner_position_relative position-relative">
                    <div class="bx_banner_slider_content  owl-carousel owl-theme ">

                        @foreach ($banners as $banner)
                        <div class="bx_banner_slider_item item">
                            <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"
                                alt="{{ $banner->image }}"></div>
                        @endforeach


                    </div>
                    <!-- <div class="bx_banner_discount_content ">
                            <div class="bx_banner_discount_item text_one">
                                <div class="bx_banner_discount_text">
                                    <p>50% <span class="bx_font_16_r"> off</span></p>
                                </div>
                                <div class="bx_banner_discount_image">
                                    <img src="image/banner/banner_right.png" alt="">
                                </div>
                            </div>
                            <div class="pt-3 bx_abs">
                                <div class="bx_banner_discount_item text_two">
                                    <div class="bx_banner_discount_text ">
                                        <p>50% <span class="bx_font_16_r"> off</span></p>
                                    </div>
                                    <div class="bx_banner_discount_image">
                                        <img src="image/banner/banner_right.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner -->
<!-- Start Book Details -->
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
                            <form action="" method="get" id="bx_book_sort_form_category">
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
<!-- End Book Details -->
<section class="bx_book_show_style bx_section_p_30">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-5 col-md-9">
                <div class="row">
                    @foreach ($all_books as $book)
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="bx_book_item_content d-flex flex-column">
                            <div class="bx_book_item_img_content">
                                <div class="bx_book_item_img">
                                    <img src="{{ asset('images/book/' . $book->photo) }}" alt="{{ $book->photo }}">
                                </div>
                                <div class="bx_book_item_overlay">
                                    <ul>
                                        <li><a href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                                target="_blank"><span><i class="fas fa-eye"></i></span></a></li>
                                        <li><span data-id="{{ $book->id }}" class="bx_book_addcart "><i
                                                    class="fas fa-shopping-cart"></i></span></li>
                                        <li
                                            class="{{ (Auth::check() && DB::table('book_user')->where([['book_id', $book->id],['user_id',Auth::user()->id]])->exists()) ? 'active' : '' }}">
                                            <span data-id="{{ $book->id }}"
                                                class="bx_book_wishlist bx_book_wishlist_btn"><i
                                                    class="fas fa-heart"></i></span></li>
                                    </ul>
                                </div>
                                <span class="bx_badge d-flex justify-content-end flex-column">New</span>
                            </div>
                            <div class="bx_book_item_text d-flex flex-column">
                                <h4>{{ $book->title }}</h4>
                                <div
                                    class="bx_book_item_price_rate d-flex flex-column flex-md-row justify-content-between">
                                    <span class="bx_book_item_price d-flex">
                                        <span
                                            class="bx_book_selling">{{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price)  }}</span>
                                        @if ($book->discount != null)
                                        <span class="bx_book_original pl-2">{{ currency_type($book->price) }}</span>
                                        @endif
                                    </span>
                                    <ul class="d-inline-flex ">
                                        @php
                                        $rate = DB::table('reviews')->where('book_id', $book->id)->count() > 0 ?
                                        round(DB::table('reviews')->where('book_id', $book->id)->sum('rating') /
                                        DB::table('reviews')->where('book_id', $book->id)->count(), 2) : 0;
                                        for ($i=0; $i <5 ; $i++) { echo '<li><i class="' ,( $rate <=$i?' far
                                            fa-star':'fas fa-star'),'"></i></li>';
                                            }
                                            @endphp
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @php
                $all_books->appends(Request::all())->links();
                @endphp
                @if ($all_books->lastPage() > 1)
                <div class="row">
                    <div class="col-12">
                        <div class="bx_book_pagination_content">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if (! $all_books->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $all_books->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif
                                    @for ($i = 1; $i <= $all_books->lastPage(); $i++)
                                        <li class="page-item{{ ($all_books->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $all_books->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        @if ($all_books->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $all_books->nextPageUrl() }}"
                                                aria-label="Next">
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
            <div class="col-7 col-md-3 ">
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
                                            <a href="{{ url('/category/?category='. Request::get('category').'&sub='. $subcategory->id) }}"
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
                            <form method="GET" id="bx_book_price_range">
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
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/range.js') }}"></script>
<script>
    (function ($) {
        "use strict";
        var lowerSlider = $('#lower'),
            upperSlider = $('#upper'),
            lowerVal = parseInt(lowerSlider.value),
            upperVal = parseInt(upperSlider.value);

        upperSlider.oninput = function () {
            lowerVal = parseInt(lowerSlider.value);
            upperVal = parseInt(upperSlider.value);

            if (upperVal < lowerVal + 4) {
                lowerSlider.value = upperVal - 4;

                if (lowerVal == lowerSlider.min) {
                    upperSlider.value = 4;
                }
            }
        };
        lowerSlider.oninput = function () {
            lowerVal = parseInt(lowerSlider.value);
            upperVal = parseInt(upperSlider.value);
            if (lowerVal > upperVal - 4) {
                upperSlider.value = lowerVal + 4;

                if (upperVal == upperSlider.max) {
                    lowerSlider.value = parseInt(upperSlider.max) - 4;
                }
            }
        };

        /*Code for book wishlist*/
    $('.bx_book_wishlist_btn').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var book_id = $(this).data('id');
        var $This = $(this);
        $.ajax({
            type: 'POST',
            url: '/wishlist/'+book_id+'/add',
            data: {
                id: book_id
            },
            success: function (data) {
                if (data.success) {
                    toastr.success(data.success,'');
                    $This.parent('li').addClass('active');
                }else if(data.remove){
                    toastr.warning(data.remove,'');
                    $This.parent('li').removeClass('active');
                }
                 else {
                    toastr.error(data.error,'');
                }
            }
        });
    });

    $("#bx_book_sort").on("change",function(){
        event.preventDefault();
        let formData = $('#bx_book_sort_form_category').serialize();
        let urlParams = new URLSearchParams(window.location.search);
        let category = urlParams.get('category');
        let sub = urlParams.get('sub');
        if (sub != null) {
            let finalForm = "category?category=" + category + "&sub="+ sub + "&" + formData;
            window.location.href = finalForm;
        } else {
            let finalForm = "category?category=" + category + "&" + formData;
            window.location.href = finalForm;
        }
      });
      $("#bx_book_filter_price").on("click",function(){
        event.preventDefault();
        let formData = $('#bx_book_price_range').serialize();
        let urlParams = new URLSearchParams(window.location.search);
        let category = urlParams.get('category');
        let sub = urlParams.get('sub');
        if (sub != null) {
            let finalForm = "category?category=" + category + "&sub="+ sub + "&" + formData;
            window.location.href = finalForm;
        } else {
            let finalForm = "category?category=" + category + "&" + formData;
            window.location.href = finalForm;
        }
      });

    })(jQuery);
</script>
@endsection
