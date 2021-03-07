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
                        <a class="nav-link {{ request()->is('my-section/reviews') ? 'active' : '' }}"
                            href="{{ route('user.reviews') }}">My Rating &
                            Reviews</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="bx_book_my_profile_info">
                        <div class="bx_wishlist">
                            <div class="bx_order_heading ">
                                <h4 class="bx_info_header bx_font_16_r pb-4">My Reviews (<span
                                        class="total_wishlist">{{ $user->reviews->count() }}</span>)</h4>
                                <p class="bx_font_16_r pb-2">Your product rating & review:</p>
                                <ul class="d-flex flex-column">
                                    @php
                                    $reviews = $user->reviews()->paginate(5);
                                    @endphp
                                    @forelse ($reviews as $review)

                                    <li class="my-3 bx_user_wishlist_item">
                                        <div
                                            class="bx_user_list_item d-flex justify-content-start align-items-center">
                                            <div class="bx_user_list_item_img d-flex align-items-center w-50">
                                                <img width="40px"  src="{{ asset('images/book/book.png') }}" alt="">
                                                <div class="pl-4 d-flex flex-column">
                                                    <div class="bx_user_list_item_title bx_font_14_r">
                                                        <a href="{{ url('book/'.$review->book->id .'/'.strtolower(str_replace(" ", "-", $review->book->title))) }}">
                                                        {{ $review->book->title }}
                                                    </a>
                                                    </div>
                                                    <ul class="d-inline-flex pt-2">
                                                        @php
                                                        for ($i=0; $i <5 ; $i++) { echo '<li><i class="' ,( $review->rating <=$i?' far
                                                            fa-star':'fas fa-star'),'"></i></li>';
                                                            }
                                                            @endphp
                                                    </ul>
                                                    <p class="bx_font_12_r text-muted pt-3">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    @empty
                                    <li class="py-2">
                                        <p class="bx_font_16_r text-center">No Rating Yet</p>
                                    </li>
                                    @endforelse
                                </ul>
                                @if ($reviews->lastPage() > 1)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="bx_book_pagination_content">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    @if (! $reviews->onFirstPage())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $reviews->previousPageUrl() }}"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true"><i
                                                                    class="fas fa-arrow-left"></i></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                                                        <li
                                                            class="page-item{{ ($reviews->currentPage() == $i) ? ' active' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $reviews->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                        @endfor
                                                        @if ($reviews->hasMorePages())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $reviews->nextPageUrl() }}"
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
