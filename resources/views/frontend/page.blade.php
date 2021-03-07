@extends('layouts.frontend')
@section('title')
{{ $page->title }}
@endsection
@section('styles')
<style>
    .page ol,
    .page ul {
        list-style: inherit;
    }

    .page li {
        line-height: 26px;
    }

    .bx_main_header ul {
        list-style: none;
    }

    footer ul {
        list-style: none;
    }

</style>
@endsection
@section('content')
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
<section class="page bx_section_p_30">
    <div class="container p-md-0">
        {!! $page->content !!}
    </div>
</section>
@endsection
