@extends('layouts.frontend')
@section('styles')
    <style>
        .bx_author_book_item .bx_author_book_title {
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
<!-- Start Header Bottom -->

<!-- End Header Bottom -->
<!-- Start Banner -->
<section class="bx_banner bx_section_p_30 home_page">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12 col-md-12 p-0">
                <div
                    class="bx_banner_slider_content  owl-carousel owl-theme d-flex justify-content-center align-items-end">
                    @foreach ($banners as $banner)


                    <div class="bx_banner_slider_item item">
                        <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"
                            alt="{{ $banner->image }}"></div>
                    @endforeach
                </div>
            </div>
{{--            <div class="col-12 col-md-4 mt-3 mt-md-0 d-none d-md-block">--}}
{{--                <div class="bx_banner_discount_content d-flex flex-column align-items-center">--}}
{{--                    @if (is_object($ads_banner))--}}

{{--                    <div class="bx_banner_discount_item">--}}
{{--                        <a href="{{ $ads_banner->link }}" target="_blank" class="d-block h-100">--}}
{{--                            --}}{{-- <div class="bx_banner_discount_text">--}}
{{--                                <p>50% <span class="bx_font_16_r"> off</span></p>--}}
{{--                            </div> --}}
{{--                            <div class="bx_banner_discount_image" style="background: url('{{ asset('images/ads/banner/' . $ads_banner->image) }}');--}}
{{--                                background-position: center center;--}}
{{--                                background-size: cover;">--}}
{{--                                --}}{{-- <img src="{{ asset('images/banner/banner_right.png') }}" alt=""> --}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="bx_banner_discount_item text_two mt-2">--}}
{{--                        <a href="{{ $ads_banner->link_two }}" target="_blank" class="d-block h-100">--}}
{{--                            --}}{{-- <div class="bx_banner_discount_text ">--}}
{{--                                <p>50% <span class="bx_font_16_r"> off</span></p>--}}
{{--                            </div> --}}
{{--                            <div class="bx_banner_discount_image" style="background: url('{{ asset('images/ads/banner/' . $ads_banner->image_two) }}');--}}
{{--                                background-position: center center;--}}
{{--                                background-size: cover;">--}}
{{--                                --}}{{-- <img src="{{ asset('images/banner/banner_right.png') }}" alt=""> --}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</section>
<!-- End Banner -->
@php
$best_seller_books = App\Models\Book::where('best_sale', 1)->where('status', 1)->get();
@endphp
@if ($best_seller_books->count() > 0)
<section class="bx_best_seller_book bx_section_p_30 ">
    <div class="container p-md-0">
        <div class="bx_best_seller_book_content bx_section_inner_p_30 bx_section_box">
            <div class="bx_section_headding">
                <h3>Recently Sold Products</h3>
            </div>
            <div class="best_seller_book_slider d-flex justify-content-between  owl-carousel owl-theme">
                @foreach ($best_seller_books as $book)
                <div class="bx_author_book_item item">
                    <div class="bx_author_book_wrapper">
                        <a class="bx_author_book_link"
                            href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                            target="_blank">

                            <div class="bx_author_book_add_to_cat">
                                <div class="bx_author_book_image_content">
                                    <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}" alt="">
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
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@foreach ($home_page_category as $key => $main_cat)
<!-- Start Popular Author -->
<section class="bx_popular_author bx_section_p_30 ">
    <div class="container p-md-0">
        <div class="bx_popular_author_content bx_section_inner_p_30 bx_section_box">
            @php
            $home_page_item = DB::table('books')
            ->join('book_sub_category', function ($book) {
            $book->on('books.id', 'book_sub_category.book_id')->where('status', 1);
            })
            ->join('sub_categories', function ($sub) {
            $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
            })
            ->join('categories', function ($cat) {
            $cat->on('sub_categories.category_id', 'categories.id');
            })->select('books.*')->orderBy('id', 'asc')
            ->where('categories.id', $main_cat)->distinct()
            ->get();
            @endphp
            <div class="bx_section_headding">
                @php
                $category = DB::table('categories')->where('id', $main_cat)->get();
                @endphp
                <h3>{{ $category->first()->title }}</h3>
            </div>
            <div class="bx_author_book_content d-flex justify-content-between owl-carousel owl-theme">
                @foreach ($home_page_item as $book)
                <div class="bx_author_book_item item">
                    <div class="bx_author_book_wrapper">
                        <a class="bx_author_book_link"
                            href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                            target="_blank">

                            <div class="bx_author_book_add_to_cat">
                                <div class="bx_author_book_image_content">
                                    <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}" alt="">
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
                                    @php
                                    $author = DB::table('authors')->where('id', $book->author_id)->get();
                                    @endphp
                                    <p>{{ $author->first()->name }}</p>
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
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End Popular Author -->
@if ($key == 2)
<!-- Start Call To Action -->
<section class="bx_call_to_action bx_section_p_30">
    <div class="container p-md-0">
        <div class="row">
            @if (is_object($ads_bottom))
            <div class="col-md-6">
                <div class="bx_call_to_action_content d-flex justify-content-center align-items-center">
                    <a href="{{ $ads_bottom->link }}" target="_blank" rel="noopener noreferrer" class="h-100">
                        <div class="bx_call_to_action_content_img">
                            <img class="img-fluid" src="{{ asset('images/ads/bottom/' . $ads_bottom->image) }}"
                                alt="adds">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 pt-4 pt-md-0">
                <div class="bx_call_to_action_content d-flex justify-content-center align-items-center">
                    <a href="{{ $ads_bottom->link_two}}" target="_blank" rel="noopener noreferrer" class="h-100">
                        <div class="bx_call_to_action_content_img">
                            <img class="img-fluid" src="{{ asset('images/ads/bottom/' . $ads_bottom->image_two) }}"
                                alt="adds">
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- End Call To Action -->
@endif
@endforeach

<!-- Start Sponsor -->
@if (count($companys) > 0)
<section class="bx_sponsor bx_section_p_30">
    <div class="container p-md-0">
        <div class="row sponsor_aria">
            <div class="col-12">
                <div
                    class="bx_sponsor_content bx_section_inner_p_30 d-flex justify-content-between owl-carousel owl-theme">
                    @foreach ($companys as $item)
                    <div class="bx_sponsor_item">
                        <a href="{{ $item->link }}">
                            <img src="{{ asset('images/company/' . $item->image) }}" alt="{{ $item->image }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="top: 30%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Note:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="bx_font_18_m pb-3">
                    আমারদের ওয়েবসাইট কাজ চলতেছে
                </p>
                <p class="bx_font_18_m ">
                    আমাদের সাথে থাকার জন্যা ধন্যবাদ|😀😀😀
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>
<!-- End Sponsor -->
@endsection
@section('scripts')
<script type="text/javascript">

        $(window).on('load', function () {
            $('#exampleModal').modal('show');
        });

</script>
@endsection
