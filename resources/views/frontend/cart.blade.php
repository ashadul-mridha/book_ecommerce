@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')
<!-- Start Banner -->
<section class="bx_banner bx_section_p_30">
    <!--<div class="container p-md-0">-->
    <!--    <div class="row align-items-center">-->
    <!--        <div class="col-12 col-md-5 col-lg-4 mt-3 mt-md-0 pr-md-0">-->
    <!--            <div class="breadcrumb_content">-->
    <!--                <div class="breadcrumb_title">-->
    <!--                    <h1>Products Cart</h1>-->
    <!--                </div>-->
    <!--                <nav class="breadcrumb">-->
    <!--                    <a class="breadcrumb-item  bx_font_16_r" href="{{ url('/') }}">Home</a>-->
    <!--                    <span class="breadcrumb-item bx_font_16_r active">Cart</span>-->
    <!--                </nav>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <div class="col-12 col-md-7 col-lg-8 pl-md-0 p-0">-->
    <!--            <div-->
    <!--                class="bx_banner_slider_content  owl-carousel owl-theme d-flex justify-content-center align-items-end">-->
    <!--                @foreach ($banners as $banner)-->
    <!--                <div class="bx_banner_slider_item item">-->
    <!--                    <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"-->
    <!--                        alt="banner slider image">-->
    <!--                </div>-->
    <!--                @endforeach-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</div>-->
</section>


<!-- End Banner -->
<section class="bx_cart_page">
    <div class="container p-md-0">
        <div class="row">
            <div class="col-md-12 col-lg-10 offset-lg-1">

                    <div class="bx_cart_content d-flex flex-column">
                        <div class="bx_cart_header_content row align-items-center">
                            <div class="bx_cart_header_item bx_font_18_m col-5 col-md-6">Book</div>
                            <div class="bx_cart_header_item bx_font_18_m col-2">Price</div>
                            <div class="bx_cart_header_item bx_font_18_m col-3 col-md-2">Quantity</div>
                            <div class="bx_cart_header_item bx_font_18_m col-2">Total</div>
                        </div>
                        @foreach ($cart_items as $item)
                        <div class="bx_cart_body_content row align-items-center">
                            <div class="bx_cart_body_item col-5 col-md-6">
                                <input type="hidden" name="cart_id[]" value="{{ $item->id }}">
                                <div class="media align-items-center">
                                    <a class="d-flex align-self-center"
                                        href="{{ url('book/'.$item->id .'/'.strtolower(str_replace(" ", "-", $item->name))) }}">
                                        <img class="img-fluid" src="{{ ('images/book/'.$item->attributes->photo) }}"
                                            alt="">
                                    </a>
                                    <div class="media-body">
                                        <a
                                            href="{{ url('book/'.$item->id .'/'.strtolower(str_replace(" ", "-", $item->name))) }}">
                                            <h5 class="bx_cart_item_title">{{ ucfirst($item->name) }}</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="bx_cart_body_item col-2">
                                <p class="bx_cart_item_price" data-item-price="{{ $item->price}}">
                                    <span>{{ currency_type($item->price) }}</span>
                                </p>
                            </div>
                            <div class="bx_cart_body_item col-3 col-md-2">
                                <span class="bx_book_info_quantity_field">
                                    <input type="number" name="quantity[]" class="form-control d-inline bx_number"
                                        value="{{ $item->quantity }}" min="1">
                                    <span data-id="{{ $item->id }}"
                                        class="bx_book_info_quantity_spin d-flex flex-column justify-content-between">
                                        <span class="quantity-arrow-plus pt-1"> <i class="fas fa-sort-up"></i> </span>
                                        <span class="quantity-arrow-minus pb-1"> <i class="fas fa-sort-down "></i>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <div class="bx_cart_body_item col-2 d-flex justify-content-between">
                                <p class="bx_cart_item_total_price"
                                    data-item-total-price="{{ $item->quantity * $item->price }}">
                                    <span>{{currency_type($item->quantity * $item->price) }}</span>
                                </p>
                                <span data-id="{{ $item->id }}" class="bx_cart_remove_btn"><i
                                        class="fas fa-times"></i></span>
                            </div>
                        </div>
                        @endforeach
                        <a href="{{ url('/') }}" class="bx_book_continue_shopping bx_btn align-self-end {{ Cart::isEmpty() ? 'd-block': 'd-none' }}">Continue To Shopping</a>
                    </div>

            </div>
        </div>
        <div class="bx_cart_bottom pt-3 pt-md-5">
            <div class="row">
                <div class="col-md-12 col-lg-10 offset-lg-1 p-md-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bx_cart_bottom_left_coupon">
                                <div
                                    class="bx_cart_bottom_left_input_btn d-flex justify-content-between align-items-center">
                                    <div class="form-group">
                                        <input type="text" name="coupon_code" id="bx_cart_coupon_field"
                                            class="bx_cart_coupon_field bx_font_13_r form-control"
                                            placeholder="Enter Coupon Code">

                                    </div>
                                    <button id="bx_cart_coupon_btn" type="button" class="btn bx_btn">Coupon</button>
                                </div>
                                <span id="bx_coupon_message" class="text-danger pt-2 d-inline-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 pt-4 pt-md-0">
                            <div class="bx_cart_bottom_right">
                                <div class="bx_cart_right_heading">Cart Total </div>
                                <div class="bx_cart_right_content">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p class="bx_cart_subtotal bx_font_po_r">subtotal</p>
                                                </td>
                                                <td class="bx_cart_pr">
                                                    <span data-subtotal="{{ Cart::getSubTotalWithoutConditions() }}"
                                                        id="bx_cart_subtotal_number"
                                                        class="bx_cart_subtotal_number bx_font_po_m_18"> <span>{{currency_type( Cart::getSubTotalWithoutConditions()) }}</span>
                                                    </span>

                                                </td>
                                            </tr>
                                            <tr id="coupon_view">
                                                @foreach (Cart::getConditions() as $cartCondition)
                                                @if ($cartCondition->getType() =='coupon')
                                                <td>
                                                    <p class="bx_cart_shipping bx_font_po_r">{{ $cartCondition->getType() }}</p>
                                                </td>

                                                <td class="bx_cart_pr ">
                                                    <span class="flat bx_font_po_m" id="coupon_dicount">{{ $cartCondition->getValue() }}</span>
                                                </td>
                                                @endif
                                                @endforeach
                                            </tr>

                                            <tr class="bx_cart_b_t">
                                                <td>
                                                    <p class="bx_font_po_r">Order Totals</p>
                                                </td>
                                                <td class="bx_cart_pr bx_font_po_m_18"><span><span
                                                            id="bx_book_total">{{ currency_type(Cart::getTotal()) }}</span></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="bx_cart_right_btn d-flex justify-content-between">
                                                        <a href="{{ route('checkout') }}" class=" bx_book_cart_proceed_btn bx_btn">Proceed
                                                            checkout</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>

@endsection
