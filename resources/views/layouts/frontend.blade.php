<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Express') </title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font/all.min.css') }}">
    @if (!request()->is('page/*'))
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @yield('styles')
</head>
@php
    use App\Models\Search;
    use App\Models\Category;
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
            $all_categories = Category::orderBy('id', 'desc')->get();
@endphp
<body>
    <!-- Header Start -->
    <div id="bx_main_header">
    <header class="bx_main_header">
        <div class="container p-md-0 h-100">
            <div class="row align-items-center h-100">
                <div class="col-12">
                    <div class="bx_menu_content d-lg-flex justify-content-between">
                        <div class="bx_logo_mobile_menu d-flex justify-content-between align-items-center px-3 px-lg-0">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img class="img-fluid" src="{{ asset('images/'.$header->logo) }}" alt="Logo">
                                </a>
                            </div>
                            <div class="d-md-none ">
                                <a href="{{ url('/cart') }}" class="bx_header_cart_icon">
                                    <i class="{{ $header->cart_icon }}"></i>
                                    (<span
                                        class="bx_header_total_cart">{{ Cart::getContent()->count() }}</span>)
                                </a>
                            </div>
                            <div class="bx_manubar d-lg-none">
                                <div class="top"></div>
                                <div class="middel"></div>
                                <div class="bottom"></div>
                            </div>
                        </div>
                        <nav class="bx_menu px-3 px-lg-0">
                            <div class="d-lg-flex align-items-center position-relative">

                            @php
                            $authors = DB::table('authors')->orderBy('id', 'asc')->take(39)->get();
                            @endphp

                            @php
                            $publishers = DB::table('publishers')->orderBy('id', 'asc')->take(39)->get();
                            @endphp
                                <div class="bx_header_bottom_item bx_header_bottom_search position-relative">
                                    <ul class="d-lg-inline-flex">
                                        <li class="bx_nav_item  {{ request()->is('/') ? 'active' : '' }} ">
                                            <a class="bx_nav_link" href="{{ url('/') }}">হোম</a>
                
                                        </li>
                                        <li
                                            class="bx_nav_item   {{ request()->is('book/grid') || request()->is('book/grid/*') ? 'active' : '' }} ">
                                            <a class="bx_nav_link" href="{{ url('/book/grid') }}">বই</a>
                                        </li>
                                        <li
                                            class="bx_nav_item {{ request()->is('book/authors') ||request()->is('book/author/*') ? 'active' : '' }} ">
                                            <a id="bx_nav_author" class="bx_nav_link"
                                               href="{{ route('books.authors') }}">লেখক
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                        </li>
                                        <li
                                            class="bx_nav_item{{ (request()->is('book/publishers') || request()->is('book/publisher/*')) ? 'active' : '' }}">
                                            <a id="bx_nav_publisher" class="bx_nav_link"
                                               href="{{ route('books.publishers') }}">প্রকাশনী
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                        </li>
                                        <li class="bx_nav_item">
                                            @php
                                                $best_books = App\Models\Book::where('best_sale', 1)->where('status', 1)->get();
                                            @endphp
                                            <a class="bx_nav_link"
                                               href="{{ $best_books->count() > 0 ? route('book.best_seller') : '#' }}">বেস্টসেলার বই</a>
                                        </li>
                                        <li class="bx_nav_item">
                                            <a class="bx_nav_link" href="{{ url('/boimela') }}">বইমেলা ২০২০</a>
                                        </li>
                                        <ul id="bx_nav_publisher_menu"
                                            class="bx_nav_sub_menu d-flex justify-content-between flex-wrap">
                                            @foreach ($publishers as $publisher)
                                                <li><a class="d-flex align-items-center"
                                                       href="{{ route('publisher.details', $publisher->id) }}"><i
                                                            class="bx_nav_icon fas fa-dot-circle"></i>{{$publisher->name}}</a></li>
                
                                            @endforeach
                                            <li><a href="{{ route('books.publishers') }}">see more...</a></li>
                                        </ul>
                                        {{-- <form action="{{ route('books.search') }}"  method="GET">
                                            <div class="input-group">
                                                <input type="text" id="bx_book_search_value" class=" form-control bx_font_16_r"
                                                       placeholder="{{ $searchs->search_placeholder }}" name="term">
                                                <div class="input-group-append">
                                                    <button type="submit" id="bx_book_search_btn" class="input-group-text"><i
                                                            class="{{ $searchs->search_icon }}"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    
                                        
                                        <ul class="bx_search_results asadul" id="bx_search_results">
                                        
                                        </ul> --}}
                                </div>
                                

                                <div
                                    class="bx_navbar_right_content ml-lg-auto d-flex justify-content-between align-items-center">
                                    <div class="bx_navbar_right_item d-flex">
                                        <div class="bx_navbar_right_cart d-none d-md-block">
                                            <a href="{{ url('/cart') }}" class="bx_header_cart_icon">
                                                <i class="{{ $header->cart_icon }}"></i>
                                                (<span
                                                    class="bx_header_total_cart">{{ Cart::getContent()->count() }}</span>)
                                            </a>
                                        </div>
                                        <div class="bx_navbar_right_phone">
                                            <a href="tel:{{ $header->contact_number }}">
                                            <i class="{{ $header->contact_icon }} pr-1"></i>
                                            <span>{{ $header->contact_number }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="bx_navbar_right_item">
                                        <div class="bx_navbar_right_login">
                                            @guest
                                            <a class="bx_login"
                                                href="{{ route('login') }}">{{ $header->button_name }}</a>
                                            @else
                                            <div class="dropdown">
                                                <button class=" dropdown-toggle bx_login" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">{{ Illuminate\Support\Str::limit(Auth::user()->name, 7, '..') }}</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('user.deshboard') }}">My
                                                        Profile</a>
                                                    <a class="dropdown-item" href="{{ route('user.orders') }}">My
                                                        Orders</a>
                                                    <a class="dropdown-item" href="{{ route('user.wishlist') }}">My
                                                        Wishlist</a>
                                                    <a class="dropdown-item" href="{{ route('user.reviews') }}">My
                                                        Revies</a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-home-form').submit();">
                                                        <i class="fa fa-power -off"></i>Logout
                                                    </a>

                                                    <form id="logout-home-form" action="{{ route('logout') }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endguest

                                    </div>
                                </div>
                            </div>
                    </div>

                    </nav>

                </div>
            </div>
        </div>
        </div>
    </header>
    <div class="clearfix"></div>
    <div class="container-fluid custom_container bx_header_bottom bx_main_header">
        <div class="container p-md-0 top_menu">
            <div class="col-md-12">
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
                    <div class="col-12 col-md-9">
                    {{-- menu --}}
                    <div class="bx_header_bottom_item bx_header_bottom_search position-relative search_aria">
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
                        <ul id="bx_nav_author_menu"
                            class="bx_nav_sub_menu d-flex justify-content-between flex-wrap">
                            @foreach ($authors as $author)
                                <li><a class="d-flex align-items-center"
                                       href="{{ route('author.details', $author->id) }}"><i
                                            class="bx_nav_icon fas fa-dot-circle"></i>{{$author->name}}</a></li>

                            @endforeach
                            <li><a href="{{ route('books.authors') }}">see more...</a></li>
                        </ul>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <h1 id="el"></h1>
    <!-- End Header -->
    @yield('content')
    <!-- Start Footer -->
    <footer class="">
        <div class="bx_footer">
            <div class="container p-md-0">
                <div class="row px-2 px-md-5 px-lg-4 ">
                    <div class="col-12 col-md-6 col-lg-3  px-2 px-md-4 ">
                        <div class="bx_footer_item  mx-auto d-flex flex-column">
                            <div class="bx_footer_item_heading bx_footer_logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('images/footer/'.$footer_1st->logo) }}" alt="logo"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="bx_footer_item_description">
                                <p>{{ $footer_1st->description }}</p>
                            </div>
                            @php
                            $icon = explode('|', $footer_1st->social_icon);
                            $url = explode('|', $footer_1st->social_link);
                            $data = array_combine($icon, $url);
                            @endphp
                            <div class="bx_footer_item_social">
                                <ul class="d-flex flex-wrap">
                                    @foreach ($data as $key => $item)
                                    <li>
                                        <a href="{{ $item }}" class="social_icon" target="_blank">
                                            <i class="{{ $key }}"></i>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-2 px-md-4 pt-4 pt-md-0">
                        <div class="bx_footer_item  mx-auto">
                            <div class="bx_footer_item_heading">
                                <h4>{{ $footer_2nd->title }}</h4>
                            </div>
                            @php
                            $name = explode('|', $footer_2nd->name);
                            $url = explode('|', $footer_2nd->link);
                            $datas = array_combine($name, $url);
                            @endphp
                            <div class="bx_footer_item_quick_link bx_footer_all_link">
                                <ul class="d-flex flex-column">
                                    @foreach ($datas as $key => $value)
                                    <li><a
                                            href="{{ $value === "/" ? $value : ($value === "#" ? "#" : "page/". $value) }}">{{ ucwords($key) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-2 px-md-4 pt-4 pt-lg-0">
                        <div class="bx_footer_item">
                            <div class="bx_footer_item_heading">
                                <h4>{{ $footer_3rd->title }}</h4>
                            </div>
                            @php
                            $name = explode('|', $footer_3rd->name);
                            $url = explode('|', $footer_3rd->link);
                            $datas = array_combine($name, $url);
                            @endphp
                            <div class="bx_footer_item_service_link bx_footer_all_link">
                                <ul class="d-flex flex-column">
                                    @foreach ($datas as $key => $value)
                                    <li><a href="{{ $value === "#" ? "#" : "page/". $value }}">{{ ucwords($key) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-2 px-md-4 pt-4 pt-lg-0">
                        <div class="bx_footer_item">
                            <div class="bx_footer_item_heading">
                                <h4>{{ $footer_4th->title }}</h4>
                            </div>
                            @php
                            $name = explode('|', $footer_4th->name);
                            $url = explode('|', $footer_4th->link);
                            $datas = array_combine($name, $url);
                            @endphp
                            <div class="bx_footer_item_company_link bx_footer_all_link">
                                <ul class="d-flex flex-column">
                                    @foreach ($datas as $key => $value)
                                    <li><a href="{{ $value === "#" ? "#" : "page/". $value }}">{{ ucwords($key) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container p-md-0">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="bx_footer_copyright">
                        <p> &copy; 2020 All Copyright Reserved. Design by
                            <span>Book Express</span></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <button id="bx_back_to_top" title="Go to top">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v7.0'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>

    <!-- Your Chat Plugin code -->
{{--    <div class="fb-customerchat" attribution=setup_tool page_id="106481647466215">--}}
    </div>

    <!-- End Footer -->
    <script src="{{ asset('vendor/jquery/jquery-3.4.1.min.js') }}"></script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    <script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr.min.js') }}"></script>
    <script src="{{ asset('js/superplaceholder.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    {!! Toastr::message() !!}
    <script>
        (function ($) {
            "use strict";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.bx_book_addcart').on('click', function () {
                var book_id = $(this).data('id');
                var $This = $(this);
                $.ajax({
                    type: 'GET',
                    url: '/add/to/cart/' + book_id,
                    data: {
                        id: book_id
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
            $('#bx_book_search_value').on('keyup', function () {
                var query = $(this).val();
                if (query.length >= 2) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('books.live_search') }}",
                        data: {
                            query: query
                        },
                        success: function (data) {
                            $('#bx_search_results').addClass('active').html(data);
                        }
                    });
                }

            });
            $(document).mouseup(function (e) {
                var container = $("#bx_search_results");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.removeClass('active');
                }
            });
            $('#bx_book_category_submit .bx_book_category_item a').on('click', function () {
                var $cat_id = $(this).data('value');
                if ($cat_id) {
                    $('#bx_book_category_form').submit();
                }
            });

            if (document.querySelector('input#bx_book_search_value')) {
                superplaceholder({
                    el: document.querySelector('input#bx_book_search_value'),
                    sentences: [
                        'Search By Books ( ex. মেঘডুবি - কিঙ্কর আহসান )',
                        'Search By Books ( ex. অর্ধবৃত্ত - সাদাত হোসাইন )',
                        'Search By Books ( ex. চন্দ্রলেখা - আবদুল্লাহ  আল ইমরান )',
                        'Search By Books ( ex. সুখী বিবাহিত ব্যাচেলর - মৌরি মরিয়ম )',
                    ],
                    options: {
                        letterDelay: 100,
                        sentenceDelay: 1000,
                        startOnFocus: false,
                        loop: true,
                        shuffle: false,
                        showCursor: false,
                        cursor: '|'
                    }
                });

            }
        })(jQuery)

    </script>
    @yield('scripts')
</body>

</html>
