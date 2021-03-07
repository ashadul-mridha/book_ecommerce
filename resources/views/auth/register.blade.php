@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<!-- Start Banner -->
<section class="bx_banner bx_section_p_30">
    <div class="container p-md-0">
        <div class="row align-items-center">
            <div class="col-12 col-md-4 col-lg-4 mt-3 mt-md-0 pr-md-0">
                <div class="breadcrumb_content">
                    <div class="breadcrumb_title">
                        <h1>Sing.up</h1>
                    </div>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/') }}">Home</a>
                        <span class="breadcrumb-item bx_font_16_r active">Sing up</span>
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

<section class="bx_registration bx_section_p_30">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="bx_registration_form_content d-flex flex-column">
                    <div class="bx_registration_heading bx_section_headding">
                        <h3>Sing up your account</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="bx_registration_form_fields d-flex flex-column">
                            <div class="form-group">
                                <label class="bx_font_14_r bx_registration_label" for="name">Full Name</label>
                                <input type="text" id="name"
                                    class="bx_registration_field bx_font_13_r form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Enter your full name">
                                @error('name')
                                <span class="invalid-feedback pt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="bx_font_14_r bx_registration_label" for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bx_registration_field bx_font_13_r form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email">
                                @error('email')
                                <span class="invalid-feedback pt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="bx_font_14_r bx_registration_label" for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="bx_registration_field bx_font_13_r form-control @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback pt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="bx_font_14_r bx_registration_label" for="password_confirmation">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation"
                                    id="password_confirmation" class="bx_registration_field bx_font_13_r form-control"
                                    placeholder="Confirm Password" required>
                            </div>

                            <div class="bx_registration_btn mt-3 mt-md-4">
                                <button type="submit" class="btn ">Register</button>
                            </div>
                        </div>
                    </form>
                    <div class="bx_registration_footer">
                        <p class="bx_registration_registration bx_font_13_r">
                            <a href="{{ route('login') }}">Have an account?</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5 offset-lg-1 pt-4 pt-md-0">
                <div class="bx_registration_text_content">
                    <div class="bx_registration_heading bx_section_headding">
                        <h3>About Our Site details</h3>
                    </div>
                    <div class="bx_registration_text">
                        <p class="bx_font_13_r">Why I say old chap that is sping lavatory chip shop gosh off his,
                            smashing boot are you
                            taking the piss posh loo brilliant matie boy young.!! Why I say old chap that is sping
                            brilliant matie boy young.!! Why I say old chap that is sping lavatory chip shop gosh
                            lavatory chip shop gosh off his, smashing boot are you taking the piss posh loo
                            off his, smashing boot are you taking the piss posh loo brilliant matie boy young.!!</p>
                        <p class="bx_font_13_r">
                            Why I say old chap that is sping lavatory chip shop gosh off his, smashing boot are you
                            taking the piss posh loo brilliant matie boy young.!! Why I say old chap that is sping
                            lavatory chip shop gosh off his, smashing boot are you taking the piss posh loo
                            brilliant matie boy young.!! Why I say old chap that is sping lavatory chip shop gosh
                            off his, smashing boot are you taking the piss posh loo brilliant matie boy young.!!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
