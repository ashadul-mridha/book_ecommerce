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
                            <img class="img-fluid rounded-circle" src="{{ asset('images/user/' . $user->photo) }}" alt="" width="50px">
                        </div>
                        <div class="user_info_content  pl-3">
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

                        <div class="my_info">
                            @if ($user->phone != null)


                            <div class="bx_info_heading  ">
                                <span class="bx_info_header bx_font_16_m">Mobile number</span>
                                <span class="ml-4 bx_font_14_r bx_info_change edit_phone"
                                    onclick="phoneNumberEdit()">Change
                                    Mobile
                                    Number</span>
                            </div>
                            <form action="" class="mt-3">
                                <div class="form-group ">
                                    <div class="row" id="phoneSection">
                                        <div class="col-6">
                                            <input type="text" name="phone"
                                                class="form-control bx_info_field phone-change bx_font_14_r"
                                                value="{{ $user->phone }}" placeholder="Enter your new mobile number"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="otpSection">
                                        <div class="col-6">
                                            <label for="otpCode" class="form-label bx_font_14_r pb-3">Please
                                                enter
                                                your code</label>
                                            <input type="text" name="otpCode"
                                                class="form-control bx_info_field bx_font_14_r " id="otpCode">
                                        </div>
                                    </div>

                                    <input type="button" onclick="updatePhoneNumber()"
                                        class="btn btn-success font-weight-bold pl-4 pr-4 mt-3 d-none" id="phoneNumber"
                                        value="Send OTP">

                                    <input type="button" onclick="updatePhoneNumberViaOtp()"
                                        class="btn btn-success font-weight-bold pl-4 pr-4 mt-3 d-none"
                                        id="phoneNumberViaOtp" value="Confirm Code">
                                    <span id="phoneChangeSuccessMsg" class="msg1 text-success ml-4"
                                        style="display: none;"></span>
                                </div>
                            </form>
                            @endif

                            <div class="bx_info_heading ">
                                <span class="bx_info_header bx_font_16_m">Email Address</span>
                                <span class="bx_info_change bx_font_14_r ml-4 edit_email"
                                    onclick="emailAddressEdit()">Change
                                    Email
                                    Address</span>
                            </div>
                            <form action="" class="mt-3">
                                <div class="form-group ">
                                    <div class="row" id="emailSection">
                                        <div class="col-6">
                                            <input type="text" name="email"
                                                class="form-control bx_info_field bx_font_14_r email-change"
                                                value="{{ $user->email }}" placeholder="Enter your new email address"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="otpSection2">
                                        <div class="col-6">
                                            <label for="otpCode2" class="form-label bx_font_14_r pb-3">Please
                                                enter
                                                your code</label>
                                            <input type="text" name="otpCode2"
                                                class="form-control bx_info_field personal otpCode2" id="otpCode2">
                                        </div>
                                    </div>

                                    <input type="button" onclick="updateEmailAddress()"
                                        class="btn btn-success font-weight-bold pl-4 pr-4 mt-3 d-none" id="emailAddress"
                                        value="Send OTP">

                                    <input type="button" onclick="updateEmailAddressViaOtp()"
                                        class="btn btn-success font-weight-bold pl-4 pr-4 mt-3 d-none"
                                        id="emailAddressViaOtp" value="Confirm Code">
                                    <span id="emailChangeSuccessMsg" class="msg1 text-success ml-4"
                                        style="display: none;"></span>
                                </div>
                            </form>
                            <div class="bx_info_heading ">
                                <span class="bx_info_header bx_font_16_m">My Information</span>
                                <span class="bx_info_change bx_font_14_r ml-4 my_info_edit"
                                    onclick="personalInfoEdit()">Change
                                    Information</span>
                            </div>
                            <form action="" class="">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name" class="form-label mt-3 mb-3">Name</label>
                                            <input type="text" name="name"
                                                class="form-control bx_info_field personal name"
                                                value="{{ $user->name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="gender" class="form-label mt-3 mb-3">Gender</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="male" id="customRadioInline1" name="gender"
                                            class="custom-control-input personal" disabled
                                            {{ $user->gender == 'male' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="female" id="customRadioInline2" name="gender"
                                            class="custom-control-input personal" disabled
                                            {{ $user->gender == 'female' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                </div>
                                <input type="button" onclick="updateUserInfo()"
                                    class="btn btn-success text-light font-weight-bold d-none  pl-4 pr-4 mt-3"
                                    id="personalInfo" value="Save">
                                <span id="userInfoChangeMsg" class="msg1 text-success ml-4"
                                    style="display: none;"></span>
                            </form>


                            <div class="bx_info_heading   ">
                                <span class="bx_info_header bx_font_16_m">Profile Picture</span>
                                <span class="bx_info_change bx_font_14_r ml-4 edit_image" onclick="imageEdit()">Change
                                    Profile
                                    Picture</span>
                                <p class="pt-4"><small>(PNG/JPG/JPEG/BMP, Max. 3MB)</small></p>
                            </div>
                            <form action="" enctype="multipart/form-data" id="change-profile-image">
                                <div class="form-group">
                                    <p class="form-label mt-3 mb-3">Your Profile Photo</p>
                                    <img class="img-fluid rounded-circle userImage" id="uploadImage"
                                        src="{{ asset('images/user/'.$user->photo) }}" width="100px"
                                        alt="profile_image">
                                    <input type="file" class="image ml-5 pt-2 pb-2 pl-4 pr-4 d-none" name="profileImage"
                                        id="photo" onchange="previewImage()">
                                    <input type="hidden" name="x1" id="x1">
                                    <input type="hidden" name="x2" id="x2">
                                    <input type="hidden" name="y1" id="y1">
                                    <input type="hidden" name="y2" id="y2">
                                </div>
                                <input type="button" onclick="uploadProfileImage()"
                                    class="btn  btn-success font-weight-bold pl-4 pr-4 mt-3 d-none" id="imageInfo"
                                    value="Save">
                                <span id="imageChangeMsg" class="msg2 text-success ml-4" style="display: none;"></span>
                                <input type="hidden" name="_tk" id="_tk"
                                    value="pzYOIueQ-pW7b9OeJ54la_tTQBXHaY2bTW5-P9hrgRY">
                            </form>
                            <div class="bx_info_heading   ">
                                <span class="text">Password</span>
                                <span class="bx_info_change ml-4 pass_change" onclick="passwordEdit()">Change
                                    Password</span>
                                <!-- <span class="msg3 text-success ml-4">Info Successfully Saved</span> -->
                            </div>
                            <form action="" class="mt-3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="password" class="form-label bx_font_14_r pb-3">Your
                                                Current
                                                Password</label>
                                            <input type="password" name="oldPassword" id="oldPwd"
                                                class="form-control bx_info_field password" value="**********" disabled>
                                        </div>
                                    </div>
                                    <div class="row reset  d-none pt-3">
                                        <div class="col-6">
                                            <label for="password" class="form-label bx_font_14_r pb-3">New
                                                Password</label>
                                            <input type="password" name="password" id="newPwd"
                                                class="form-control bx_info_field password new">
                                        </div>
                                        <div class="col-6">
                                            <label for="password" class="form-label bx_font_14_r pb-3">Confirm
                                                Password</label>
                                            <input type="password" name="reTypePassword" id="renewPwd"
                                                class="form-control bx_info_field password confirm">
                                        </div>
                                    </div>
                                    <div class="error text-danger font-italic mt-3" style="display: none;">*
                                        Password doesn't match</div>
                                </div>
                                <input class="btn btn-active btn-success d-none font-weight-bold pr-4 pl-4 mt-3"
                                    id="passwordInfo" type="button" onclick="changePass()" value="Save">
                                <span id="editPassword"></span>
                            </form>


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

@endsection
