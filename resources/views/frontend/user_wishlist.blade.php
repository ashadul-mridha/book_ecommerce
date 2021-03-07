@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
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
<div class="bx_book_my_profile bx_section_p_30">
    <div class="container p-md-0">
        <div class="bx_book_my_profile_content">
            <div class="row">
                <div class="col-3">
                    <div class="user_info d-flex align-items-center">
                        <div class="user_info_img">
                            <img class="img-fluid rounded-circle" src="{{ asset('images/user/' . $user->photo) }}"
                                alt="" width="50px">
                        </div>
                        <div class="user_info_content pl-3">
                            <p>Wellcome,</p>
                            <h3>sumon</h3>
                        </div>
                    </div>
                    <div class="nav flex-column  bx_sidebar">
                        <a class="nav-link {{ request()->is('my-section/profile') ? 'active' : '' }}"
                            href="{{ route('user.deshboard') }}">My Profile</a>
                        <a class="nav-link {{ request()->is('my-section/orders') || request()->is('my-section/orders/*') ? 'active' : '' }}"
                            href="{{ route('user.orders') }}">My Order</a>
                        <a class="nav-link {{ request()->is('my-section/wishlist') ? 'active' : '' }}"
                            href="{{ route('user.wishlist') }}">My Wishlist</a>
                        <a class="nav-link  {{ request()->is('my-section/reviews') ? 'active' : '' }}"
                            href="{{ route('user.reviews') }}">My Rating &
                            Reviews</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="bx_book_my_profile_info">
                        <div class="bx_wishlist">
                            <div class="bx_order_heading ">
                                <h4 class="bx_info_header bx_font_16_r pb-4">My Wishlist (<span
                                        class="total_wishlist">{{ $user->wishlist_books->count() }}</span>)</h4>
                                <ul class="d-flex flex-column">
                                    @php
                                    $books = $user->wishlist_books()->paginate(7);
                                    @endphp
                                    @forelse ($books as $book)
                                    <li class="my-3 bx_user_wishlist_item">
                                        <div
                                            class="bx_user_list_item d-flex justify-content-between align-items-center">
                                            <div class="bx_user_list_item_img d-flex align-items-center w-50">
                                                <a href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}">
                                                    <img width="60px" src="{{ asset('images/book/book.png') }}" alt="">
                                                </a>
                                                <div class="pl-4 d-flex flex-column">
                                                    <div class="bx_user_list_item_title bx_font_16_m">
                                                        {{ $book->title }}
                                                    </div>
                                                    <span class="mt-3 user_wishlist_remove" data-id="{{ $book->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="bx_user_list_item_price pl-4">
                                                <span class="bx_book_selling font-weight-bold">
                                                    {{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price)  }}
                                                </span>
                                                @if ($book->discount != null)
                                                <span class="bx_book_original">{{ currency_type($book->price) }}</span>
                                                @endif
                                            </p>
                                            <p>
                                                <button class="user_wishlist_cart bx_book_addcart"
                                                    data-id="{{ $book->id }}"><i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </p>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="py-2">
                                        <p class="bx_font_16_r text-center">No Wishlist</p>
                                    </li>
                                    @endforelse
                                </ul>
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
                                                            <span aria-hidden="true"><i
                                                                    class="fas fa-arrow-left"></i></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                                                        <li
                                                            class="page-item{{ ($books->currentPage() == $i) ? ' active' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $books->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                        @endfor
                                                        @if ($books->hasMorePages())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $books->nextPageUrl() }}"
                                                                aria-label="Next">
                                                                <span aria-hidden="true"><i
                                                                        class="fas fa-arrow-right"></i></span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
@endsection
@section('scripts')
<script src="{{ asset('js/user.js') }}"></script>
<script>
    (function ($) {
    "use strict";
    $('.user_wishlist_remove').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var $id = $(this).data('id');
        var $This = $(this);
        $.ajax({
            type: 'post',
            url: '/my-section/wishlist/'+$id+'/delete',
            success: function (data) {
                if (data.success) {
                    toastr.success(data.success);
                    $('.total_wishlist').html(data.total);
                    $This.parent().parent().parent().parent('.bx_user_wishlist_item').remove();
                } else {
                    toastr.error(data.error);
                }
            }
        });
    });

})(jQuery);
</script>
@endsection
