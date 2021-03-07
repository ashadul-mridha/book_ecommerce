@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/author.css') }}">
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
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner -->
<section class="bx_author_list_section bx_section_p_30">
    <div class="container p-md-0">
        <div class="bx_author_search_area">
            <div class="row">
                <div class="col-md-5  ml-auto">
                    <h1 class="bx_author_search_headding bx_font_16_m">Search your favorite Publisher</h1>
                </div>
                <div class="col-md-5 mr-auto">
                    <div class="bx_author_search_form">
                        <form action="{{ route('books.publishers') }}" method="GET">
                            <div class="input-group">
                                <input id="bx_author_search_input" type="text" class="form-control bx_font_16_r"
                                    placeholder="Find your favorite Author" name="publishersearch">
                                <div class="input-group-append">
                                    <button type="submit" id="bx_author_search_btn" class="input-group-text"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <ul class="bx_author_search_results" id="bx_author_search_results" tabindex="0">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container  p-md-0">
        <div class="row">
            <div class="col-md-12 ">
                <ul class="bx_author_list bx_section_p_30">
                    @foreach ($publishers as $publisher)
                    <li class="bx_author_list_item">
                        <a href="{{ route('publisher.details', $publisher->id) }}">
                            <img class="bx_author_list_imge" src="{{ asset('images/publisher/'.$publisher->photo) }}"
                                alt="{{ $publisher->photo }}">
                            <h2 class="author_name bx_font_16_m ">{{$publisher->name}}</h2>
                            <div class="bx_author_list_item_hover">
                                <p class="author_name_hover bx_font_16_m"><strong
                                        class="font-weight-bold">Name:</strong> {{ $publisher->name }}</p>
                                <p class="author_details_hover bx_font_14_r">
                                    {{ \Illuminate\Support\Str::limit($publisher->description, $limit = 30, $end = '...') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @php
        $publishers->appends(Request::all())->links();
        @endphp
        @if ($publishers->lastPage() > 1)
        <div class="row">
            <div class="col-12">
                <div class="bx_book_pagination_content">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if (! $publishers->onFirstPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $publishers->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            @endif
                            @for ($i = 1; $i <= $publishers->lastPage(); $i++)
                                <li class="page-item{{ ($publishers->currentPage() == $i) ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $publishers->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($publishers->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $publishers->nextPageUrl() }}" aria-label="Next">
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
</section>

@endsection
@section('scripts')

<script>
    (function ($) {
        "use strict";
    $('#bx_author_search_input').on('keyup', function () {
        var query = $(this).val();
        if (query.length >= 2) {
            $.ajax({
                type: 'GET',
                url: "{{ route('books.publishers') }}",
                data: {
                    query: query
                },
                success: function (data) {
                    $('#bx_author_search_results').addClass('active').html(data);
                }
            });
        }
    });

    $(document).mouseup(function(e)
    {
        var container = $(".bx_author_search_results");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('active');
        }
    });

    })(jQuery);
</script>
@endsection
