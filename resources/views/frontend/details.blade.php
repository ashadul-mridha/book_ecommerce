@extends('layouts.frontend')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/book_details.css') }}">
@endsection
@section('content')

    <!-- Start Banner -->
    <section class="bx_banner bx_section_p_30">
        <div class="container p-md-0">
            <div class="row align-items-center">
                <div class="col-12 col-md-5 col-lg-4 mt-3 mt-md-0 pr-md-0">
                    <div class="breadcrumb_content">
                        <div class="breadcrumb_title">
                            <h1>Book Details</h1>
                        </div>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/') }}">Home</a>
                            <span class="breadcrumb-item bx_font_16_r active">details</span>
                        </nav>
                    </div>

                </div>
                <div class="col-12 col-md-7 col-lg-8 pl-md-0 p-0">
                    <div
                        class="bx_banner_slider_content  owl-carousel owl-theme d-flex justify-content-center align-items-end">
                        @foreach ($banners as $banner)
                            <div class="bx_banner_slider_item item">
                                <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"
                                     alt="banner slider image">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Banner -->
    <!-- Start Book Details -->
    <section class="bx_book_details_content bx_section_p_30">
        <div class="container p-md-0">
            <div class="row">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="bx_book_image_content">
                        <div class="bx_book_image">
                            <img src="{{ asset('images/book/' . $book->photo) }}" alt="{{ $book->photo }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 offset-lg-1 pt-4 pt-md-0">
                    <div class="bx_book_info_content d-flex flex-column">
                        <div class="bx_book_info_header bx_pb_30">
                            <h2>{{ $book->title }}</h2>
                            {{-- <p>Category: {{ $category }}</p> --}}
                            <p>
                                Category: 
                                @foreach ($category as $cat)
                                    <p class="btn btn-sm-primary">{{ $cat->title }}</p>
                                @endforeach
                            </p>
                            <p>By <a href="{{ route('author.details',  $book->author->id) }}">{{ $book->author->name }}</a></p>
                        </div>
                        
                        <div class="bx_book_info_price bx_pb_30">
                            <span class="bx_info_inner_header bx_font_16_r">price:</span>
                            <span
                                class="bx_saler_price">{{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100): $book->price) }}</span>
                            @if ($book->discount != null)
                                <span class="bx_orginal_price"><del>{{ currency_type($book->price) }}</del></span>
                            @endif
                        </div>

                        <div class="bx_book_info_reviews bx_pb_30">
                            <span class="bx_info_inner_header bx_font_16_r">Reviews: ({{ $book->reviews->count() }})</span>
                            <ul class="d-inline-flex">
                                @php
                                    $rate = $book->reviews->count() > 0 ? round($book->reviews->sum('rating') /
                                    $book->reviews->count(), 2) : 0
                                @endphp
                                <?php
                                for ($i=0; $i <5 ; $i++) {
                                    echo '<li><i class="' ,( $rate <= $i?' far fa-star':'fas fa-star'),'"></i></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="bx_book_info_status bx_pb_30">
                            <span class="bx_info_inner_header bx_font_16_r">Available:</span>
                            <span
                                class="bx_status {{ $book->quantity < 1 ? "text-danger" : "" }}">{{ $book->quantity < 1 ? "Stock Out" : "Yes" }}</span>
                        </div>

                        <div class="bx_book_info_quantity bx_pb_30 d-flex justify-content-between">
                            <span class="bx_info_inner_header ">Quantity:</span>
                            <span class="bx_book_info_quantity_field">
                            <input type="number" name="quantity" class="form-control d-inline bx_book_qty bx_number">
                            <span class="bx_book_info_quantity_spin d-flex flex-column justify-content-between">
                                <span class="quantity-arrow-plus pt-1"> <i class="fas fa-sort-up"></i> </span>
                                <span class="quantity-arrow-minus pb-1"> <i class="fas fa-sort-down "></i> </span>
                            </span>
                        </span>
                        </div>
                        <div class="bx_book_info_share bx_pb_30" data-easyshare
                             data-easyshare-url="https://www.kycosoftware.com/">
                            <span class="bx_info_inner_header ">Share On:</span>
                            <ul class="d-inline-flex">
                                <li>
                                <span title="Facebook" class="bx_share_button" data-easyshare-button="facebook"><i
                                        class="fab fa-facebook-f"></i></span>
                                </li>
                                <li>
                                <span title="Twitter" class="bx_share_button" data-easyshare-button="twitter"><i
                                        class="fab fa-twitter"></i></span>
                                </li>
                                <li>
                                <span title="Pinterest" class="bx_share_button" data-easyshare-button="pinterest"><i
                                        class="fab fa-pinterest-p"></i></span>
                                </li>
                                <li>
                                <span title="Google Plus" class="bx_share_button" data-easyshare-button="google"><i
                                        class="fab fa-google-plus-g"></i></span>
                                </li>
                            </ul>
                        </div>
                        <div class="bx_book_info_add_to_cart_btn d-flex justify-content-end">
                            <div class="bx_book_info_btn_content d-flex">
                                <button type="button" data-id="{{ $book->id }}"
                                        class="bx_book_info_cart_btn bx_font_12_r pointer-event">
                                    Add to Cart
                                </button>
                                <div class="bx_book_info_fav_btn bx_book_wishlist_btn {{ (Auth::check() && $book->wishlist_to_users()->where('user_id', Auth::user()->id)->exists()) ? 'active' : '' }}"
                                     data-id="{{ $book->id }}">
                                    <i class="fas fa-heart"></i>
                                    <span class="total">{{ $book->wishlist_to_users->count() }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Book Details -->
    <!-- Start summery -->
    <section class="bx_book_summery bx_section_p_30">
        <div class="container p-md-0">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="bx_book_summery_details_reviews">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active bx_font_16_r" id="bx_book_details_tab" data-toggle="tab"
                                   href="#bx_book_details" role="tab" aria-controls="bx_book_details"
                                   aria-selected="true">Description</a>
                                <a class="nav-item nav-link bx_font_16_r" id="bx_book_reviews_tab" data-toggle="tab"
                                   href="#bx_book_reviews" role="tab" aria-controls="bx_book_reviews"
                                   aria-selected="false">Reviews ({{ $book->reviews->count() }})</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="bx_book_details" role="tabpanel"
                                 aria-labelledby="bx_book_details_tab">
                                <div class="bx_book_details_text">
                                    <p class="bx_font_14_r">
                                        {{ $book->description }}
                                    </p>
                                    <ul>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">Title</strong> - {{ $book->title }}</li>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">Author</strong> - <a
                                                href="{{ route('author.details',  $book->author->id) }}">{{ $book->author->name }}</a>
                                        </li>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">Publisher</strong> -
                                            @if ($book->publisher_id)
                                                <a
                                                    href="{{ route('publisher.details',  $book->publisher->id) }}">{{ $book->publisher->name }}</a>
                                            @endif
                                        </li>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">IBSN</strong> - {{ $book->isbn }}</li>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">Edition</strong> - {{ $book->edition }}</li>
                                        <li><strong style="width: 80px; display: inline-block"
                                                    class="font-weight-bold">Language</strong> - {{ $book->language }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bx_book_reviews" role="tabpanel"
                                 aria-labelledby="bx_book_reviews_tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bx_book_summery_reviews">
                                            <ul class="list-unstyled">
                                                @foreach ($book->reviews as $review)
                                                    <li class="media mb-4">
                                                        <img class="mr-4" src="{{ asset('images/user/user.jpg') }}"
                                                             alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <div
                                                                class="bx_book_name_reviws d-flex justify-content-between  flex-column flex-lg-row">
                                                                <div class="bx_book_review_author_time">
                                                                    <h5 class="mt-0 mb-1 bx_font_16_b">{{ $review->user->name }}
                                                                    </h5>
                                                                    <span class="bx_book_reviews_time_date">
                                                                {{
                                                            Carbon\Carbon::parse($review['created_at'])->format('M d Y h:i:s A')}}
                                                            </span>
                                                                </div>
                                                                <div class="bx_book_review pb-3 pb-lg-0">
                                                                    <ul class="d-flex">
                                                                        <?php
                                                                        for ($i=0; $i < 5 ; $i++) {
                                                                            echo '<li><i class="' ,( $review->rating <= $i?'far fa-star':' fas fa-star'),'"></i></li>';
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <p class="bx_book_comment bx_font_14_r">
                                                                {{ $review->comment }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-4 pt-md-0">
                                        @if (Auth::user())
                                            <div class="bx_book_summery_reviews_form">
                                                <h4>Leave Your Review</h4>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="bx_font_14_r" for="comment">Comment</label>
                                                        <input type="hidden" id="review_book_id" name="book_id"
                                                               value="{{ $book->id }}">
                                                        <textarea class="form-control " name="comment" id="comment" rows="3"
                                                                  placeholder="Write your comment here"></textarea>

                                                        <span class="text-danger d-none pt-2 d-inline-block"
                                                              id="review_message"></span>

                                                    </div>
                                                    <div
                                                        class="bx_book_reviews_form_footer d-flex justify-content-between align-items-center">
                                                        <div class="bx_book_reviews_star">
                                                            <span class="bx_font_14_r">Your rating:</span>
                                                            <ul class="d-inline-flex">
                                                                <li title='Poor' data-value="1"><i class="fas fa-star"></i></li>
                                                                <li title='Fair' data-value="2"><i class="fas fa-star"></i></li>
                                                                <li title='Good' data-value="3"><i class="fas fa-star"></i></li>
                                                                <li title='Excellent' data-value="4"><i class="fas fa-star"></i>
                                                                </li>
                                                                <li title='WOW!!!' data-value="5"><i class="fas fa-star"></i>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <input type="hidden" name="rating" id="bx_user_rating" value="">
                                                        <div class="bx_book_reviews_btn">
                                                            <button class="bx_font_12_r bx_btn" id="review_submit_btn"
                                                                    type="button">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div
                                                class="bx_user_not_login d-flex flex-column justify-content-center align-items-center">
                                                <a class="bx_font_16_r" href="{{ route('login') }}">Write A Review</a>
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
    </section>
    <!-- End summery -->
    <!-- Start Popular Author -->
    <section class="bx_book_details bx_section_p_30 ">
        <div class="container p-md-0">
            <div class="bx_book_details_content bx_section_inner_p_30 bx_section_box">
                <div class="bx_section_headding">
                    <h3>{{ $related_books->first()->title }}</h3>
                </div>
                <div class="bx_book_details_slider d-flex justify-content-between owl-carousel owl-theme">
                    @foreach ($related_books->first()->subcategory as $key => $books)
                        @foreach ($books->books as $book)
                            <div class="bx_author_book_item item">
                                <div class="bx_author_book_wrapper">
                                    <a class="bx_author_book_link"
                                       href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                       target="_blank">

                                        <div class="bx_author_book_add_to_cat">
                                            <div class="bx_author_book_image_content">
                                                <img class="img-fluid" src="{{ asset('images/book/' . $book->photo) }}" alt="">

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
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Popular Author -->
    <!-- Start Sponsor -->
    @if (count($companys) > 1)
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
    <!-- End Sponsor -->
@endsection
@section('scripts')
    <script src="{{ asset('vendor/jquery-kyco-easyshare-min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            $('.bx_book_details_content .bx_number').on('mouseup keyup', function () {
                $(this).val(Math.min(100, Math.max(1, $(this).val())));
            });
            var $quantityArrowMinus = $(".quantity-arrow-minus");
            var $quantityArrowPlus = $(".quantity-arrow-plus");
            var $quantityNum = $(".bx_book_details_content .bx_number");
            $quantityNum.val(1);
            $quantityArrowPlus.on('click', function () {
                $quantityNum.val(+$quantityNum.val() + 1);
            });
            $quantityArrowMinus.on('click', function () {
                if ($quantityNum.val() > 1) {
                    $quantityNum.val(+$quantityNum.val() - 1);
                }
            });

            $('.bx_book_reviews_star ul li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });
            }).on('mouseout', function () {
                $(this).parent().children('li').each(function (e) {
                    $(this).removeClass('hover');
                });
            });

            var ratingValue = 0;
            /* 2. Action to perform on click */
            $('.bx_book_reviews_star ul li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li');
                for (var i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (var i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
                var ratingValue = parseInt($('.bx_book_reviews_star ul li.selected').last().data('value'), 10);
                $('#bx_user_rating').val(ratingValue);
            });

            /**add to cart */
            $('.bx_book_info_cart_btn').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var book_id = $(this).data('id');
                var qty = $('.bx_book_qty').val();
                $.ajax({
                    type: 'GET',
                    url: '/add/to/cart/' + book_id,
                    data: {
                        qty: qty
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.success, '');
                            $('.bx_header_total_cart').html(data.total);
                        } else {
                            toastr.error(data.error, '');
                        }
                    }
                });
            });
            /*Code for book wishlist*/
            $('.bx_book_wishlist_btn').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var book_id = $(this).data('id');
                var $This = $(this);
                $.ajax({
                    type: 'POST',
                    url: '/wishlist/' + book_id + '/add',
                    data: {
                        id: book_id
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.success, '');
                            $This.addClass('active');
                            $This.find('.total').html(data.total);
                        } else if (data.remove) {
                            toastr.warning(data.remove, '');
                            $This.removeClass('active');
                            $This.find('.total').html(data.total);
                        } else {
                            toastr.error(data.error, '');
                        }
                    }
                });
            });

            $('#review_submit_btn').on('click', function () {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var book_id = $('#review_book_id').val();
                var comment = $('#comment').val();
                var rating = $('#bx_user_rating').val();
                var $This = $(this);
                if (comment == "") {
                    $('#review_message').removeClass('d-none').html('Please Write A Comment');
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '/my-section/create/review',
                    data: {
                        book_id: book_id,
                        comment: comment,
                        rating: rating
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.success, '');
                            $('#comment').val('');
                        } else {
                            toastr.error(data.error, '');
                        }
                    }
                });
            });
        })(jQuery);

    </script>
@endsection
