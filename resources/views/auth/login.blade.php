@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')

<!-- Start Banner -->
<section class="bx_banner bx_section_p_30">
    <div class="container p-md-0">
        <div class="row align-items-center">
            <div class="col-12 col-md-4 col-lg-4 mt-3 mt-md-0 pr-md-0">
                <div class="breadcrumb_content">
                    <div class="breadcrumb_title">
                        <h1>Sing.in</h1>
                    </div>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/') }}">Home</a>
                        <span class="breadcrumb-item bx_font_16_r active">Sing in</span>
                    </nav>
                </div>

            </div>
            <div class="col-12 col-md-8 col-lg-8 pl-md-0">
                <div class="bx_banner_position_relative position-relative">
                    <div
                        class="bx_banner_slider_content  owl-carousel owl-theme d-flex justify-content-center align-items-end">
                        @foreach ($banners as $banner)
                        <div class="bx_banner_slider_item item">
                            <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"
                                alt="banner slider image">
                        </div>
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
<section class="bx_login bx_section_p_30">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12 col-md-6 ">
                <div class="bx_login_form_content d-flex flex-column">
                    <div class="bx_login_heading bx_section_headding">
                        <h3>Sing in your account</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="bx_login_form_fields d-flex flex-column">
                            <div class="form-group">
                                <label class="bx_font_14_r bx_login_label" for="email">User Name</label>
                                <input type="email" name="email" id="email"
                                    class="bx_login_field bx_font_13_r form-control  @error('email') is-invalid @enderror"
                                    placeholder="Enter your email or phone">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="bx_font_14_r bx_login_label" for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="bx_login_field bx_font_13_r form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="bx_login_remember_forgot d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label bx_font_13_r">
                                        <input type="checkbox" class="form-check-input" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        Remember Me
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                <div class="bx_login_forgot_password">
                                    <a href="{{ route('password.request') }}" class="bx_font_13_r">Forgot your
                                        password?</a>
                                </div>
                                @endif
                            </div>

                            <div class="bx_login_btn">
                                <button type="submit" class="btn ">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="bx_login_footer">
                        <p class="bx_login_registration bx_font_13_r">
                            New user?
                            <a href="{{ route('register') }}">Don't have an account?</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-4 pt-md-0">
                <div class="bx_login_image_content">
                    <!-- <img src="image/book/book.jpg" alt=""> -->
                    <div class="bx_login_image" style="background:url('{{ asset('images/login/'. $login->image) }}')">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
