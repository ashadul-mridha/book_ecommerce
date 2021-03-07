@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')
<!-- Start Banner -->
<div class="container bx_error_page">
    <div class="row">
        <div class="col-12 col-md-6 col-md-5 mx-auto">
            <div class="bx_book_error_content">
                <div class="bx_error_img">
                    <img class="img-fluid" src="{{ asset('images/error.png') }}" alt="error">
                </div>
                <div class="bx_book_error_back_btn text-center">
                    <a href="{{ URL::previous() }}" class="bx_font_14_m bx_btn">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>

@endsection
