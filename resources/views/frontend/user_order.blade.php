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
                        <div class="bx_order">
                            <div class="bx_order_heading ">
                                <h4 class="bx_info_header bx_font_16_r pb-4">My Orders <span>(0)</span></h4>
                                <div class="d-flex justify-content-start">
                                    <div class="d-flex align-items-center">
                                        <p>Order Id:</p>
                                        <form action="{{ Request::url() }}" method="get">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" name="id" class="form-control bx_info_field mt-3"
                                                        placeholder="Enter your order id"><br>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center mt-3">
                                                        <p>Status:</p>
                                                        <select name="orderStatus"
                                                            class="custom-select bx_user_order_field">
                                                            <option value="">Select Any</option>
                                                            <option value="PROCESSING">Processing</option>
                                                            <option value="APPROVED">Approved</option>
                                                            <option value="ON_SHIPPING">On Shipping</option>
                                                            <option value="SHIPPED">Shipped</option>
                                                            <option value="COMPLETED">Completed</option>
                                                            <option value="CANCELLED">Cancelled</option>
                                                            <option value="RETURNED">Returned</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-1  mt-3">
                                                    <input type="submit" class="btn bx_booK_user_btn" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end bx_book_my_profile_info --}}
                    <div class="bx_user_order_list">
                        @forelse ($orders as $order)
                        <div class="bx_user_order_wrapper pt-3 pb-2">
                            <div class="bx_user_order_meta d-flex">
                                <p>
                                    Your Order ID:
                                    <em>{{ $order->id }}</em> ({{ $order->books->count() }} items)
                                </p>
                            </div>
                            <div class="status">
                                <span
                                    class="text-uppercase border border-success text-success p-2">{{ $order->order_status }}</span>
                                @if ($order->order_status != "CANCELLED" && $order->order_status != "COMPLETED")
                                <button name="cancelOrder" type="button" class="btn btn-danger ml-3" data-toggle="modal"
                                    data-target="#bx_book_cancel_reason" data-order-id="{{ $order->id }}"
                                    data-item="{{ $order->books->count() }}" data-phone="{{ $order->billing_phone }}"
                                    data-payable="{{ $order->billing_total }}">
                                    CANCELLED
                                </button>
                                @endif
                            </div>
                            <div class="bx_user_order_content">
                                <div class="row">
                                    @foreach ($order->books as $book)
                                    <div class="col-3 ">
                                        <a href="{{ url('book/'.$book->id .'/'.strtolower(str_replace(" ", "-", $book->title))) }}"
                                            class="text-dark">
                                            <div class="bx_user_order_book">
                                                <figure class="bx_user_order_book_img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/book/'.$book->photo) }}"
                                                        alt="{{ $book->title }}">
                                                </figure>
                                                <p class="bx_user_order_book_title text-center">{{ $book->title }}</p>
                                                <div class="bx_user_order_book_price mb-4">
                                                    <p class="text-center sale_price">
                                                        {{ currency_type($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price) }}
                                                        @if ($book->discount != null)
                                                        <span
                                                            class="origila_price">{{ currency_type($book->price) }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No order found !</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        {{-- modal --}}
        <div class="modal fade" id="bx_book_cancel_reason" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cancel Your Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bx_book_content">
                            <div class="bx_book_order__meta pb-2">
                                <p class="bx_font_16_m">Your Order ID: <span id="bx_book_order_id"
                                        class="font-weight-bold"></span> (<span id="bx_book_order_item"
                                        class="font-weight-bold"> </span>) &nbsp; | &nbsp; Payable
                                    Amount: <span id="bx_book_order_payable" class="font-weight-bold"></span></p>
                            </div>
                            <div class="select-reason">
                                <p class="title pb-2">Select a Reason</p>
                                <select name="reason" id="bx_book_order_reason" class="custom-select">
                                    <option value="" selected="" disabled="">Select a reason</option>
                                    @foreach (order_cancel_reason() as $reason)
                                    <option value="{{ $reason }}">{{ $reason }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-submit bx_book_order_submit_btn"
                                    data-phone="">Confirm Cancel Order</button>
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
