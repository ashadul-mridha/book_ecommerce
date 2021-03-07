@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection
@section('content')
<!-- Start Banner -->
<section class="bx_banner bx_section_p_30">
    <!--<div class="container p-md-0">-->
    <!--    <div class="row align-items-center">-->
    <!--        <div class="col-12  pl-md-0">-->
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
<!-- check out section -->
<section class="bx_check_out_section ">
    <div class="container p-md-0">
        <div class="bx_check_out_top">
            <div class="row">
                <div class="col-md-6">
                    <div class="bx_check_out_top_link">
                        <p class="bx_cheke_link bx_font_14_l">Returning customer? <a href="#">click here to
                                login</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 offset-lg-1 pt-3 pt-md-0">
                    <div class="bx_check_out_top_link link_to_coupon">
                        <p class="bx_cheke_link bx_font_14_l">Have a coupon? <a href="{{ url('/cart') }}">Click here to
                                enter your
                                code</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bx_check_out_content">
            <form action="{{ Route('checkout') }}" method="POST" id="bx_book_checkout_form">
                <div class="row">
                    @csrf
                    <div class="col-md-6 ">
                        <div class="bx_check_out_content_left">
                            <div class="bx_check_out_left_heading">Your Order</div>
                            <div class="bx_check_out_title d-flex justify-content-between align-items-center">
                                <span class="bx_font_16_m">Product:</span>
                                <span class="bx_font_16_m">Total</span>
                            </div>
                            <div class="bx_check_out_product_list">
                                <ul>
                                    @foreach (Cart::getContent() as $item)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span class="bx_font_14_l product_title">{{ $item->name }}
                                        </span>
                                        <span class="bx_font_14_l product_qty">x {{ $item->quantity }}</span>
                                        <span
                                            class="bx_font_po_14_l product_price pl-1">{{ currency_type($item->quantity * $item->price) }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="bx_check_out_sub_total d-flex justify-content-between">
                                <span class="bx_font_14_r">Subtotal</span>
                                <span
                                    class="bx_font_po_m_18">{{ currency_type(Cart::getSubTotalWithoutConditions()) }}</span>
                            </div>
                            @foreach (Cart::getConditions() as $cartCondition)
                            @if ($cartCondition->getType() == 'coupon')
                            <div class="bx_check_out_shipping d-flex justify-content-between">
                                <div class="bx_shipping_name bx_font_14_r">{{ $cartCondition->getType() }}</div>
                                <div class="bx_check_out_shipping_list text-right">
                                    <span class="flat bx_font_po_m_18 ">{{ $cartCondition->getValue() }}</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <div id="bx_checkout_shipping_type"
                                class="bx_check_out_shipping d-flex justify-content-between">
                                @foreach (Cart::getConditions() as $cartCondition)
                                @if ($cartCondition->getType() == 'shipping')

                                <div class="bx_shipping_name bx_font_14_r">Shipping</div>
                                <div class="bx_check_out_shipping_list text-right">
                                    <span
                                        class="flat bx_font_po_m_18">{{ currency_type($cartCondition->getValue()) }}</span>
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="bx_check_out_total_order d-flex justify-content-between">
                                <span class="bx_font_14_r">Order Total</span>

                                <span
                                    class="bx_font_po_m_18 bx_book_checkout_total">{{ currency_type(Cart::getTotal()) }}</span>
                            </div>
                            <div class="bx_check_out_payment_method">
                                <div class="bx_check_out_input">
                                    <input class="bx_book_pay_type" type="radio" name="method" id="cash_on_delivery"
                                        value="cash_on_delivery">
                                    <label class="bx_font_16_m" for="cash_on_delivery">Cash on Delivery</label>
                                    <div class="bx_check_out_payment_details">
                                        <h2 class="bx_book_check_out_headding">Your Payable Amount:
                                            <span
                                                class="bx_book_payable_amount font-weight-bold">{{ currency_type(Cart::getTotal()) }}</span>
                                        </h2>
                                        <h3 class="bx_book_check_sub_headding">How to Pay</h3>
                                        <ul class="pt-2">
                                            <li>"Place Order" এ ক্লিক করুন।</li>
                                            <li>আপনি ৩-৫ কার্যদিবসের মধ্যে (ঢাকা এরিয়াতে) পার্সেল পাবেন।</li>
                                            <li>পার্সেল পাওয়ার পর, ডেলিভারি ম্যানকে আপনার পার্সেল এর মূল্য প্রদান করুন।
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                    <div class="bx_check_out_input">
                                    <input class="bx_book_pay_type" type="radio" name="method" id="nagad_pay"
                                        value="nagad_pay">
                                    <label class="bx_font_16_m" for="nagad_pay">Cash on Delivery Outside Dhaka</label>
                                    <div class="bx_check_out_payment_details">
                                        <h2 class="bx_book_check_out_headding">Your Payable Amount:
                                            <span
                                                class="bx_book_payable_amount font-weight-bold">{{ currency_type(Cart::getTotal()) }}</span>
                                        </h2>
                                        <h3 class="bx_book_check_sub_headding">How to Pay</h3>
                                        <ul class="pt-2">
                                            <li>"Place Order" এ ক্লিক করুন।</li>
                                            <li>bkash পেমেন্ট পেজ থেকে Marchent, Invoice no, Amount নিশ্চিত হোন।</li>
                                            <li>"Your bKash account number" এ আপনার বিকাশ নম্বর টি দিন "Proceed" এ ক্লিক
                                                করুন।</li>
                                            <li>আপনার মোবাইল এ আসা OTP কোড টি দিয়ে, "Proceed" এ ক্লিক করুন।</li>
                                            <li>এখন, আপনি একটি নিশ্চিতকরণ এসএমএস পাবেন।</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="bx_check_out_input">
                                    <input class="bx_book_pay_type" type="radio" name="method" id="bkash_pay"
                                        value="bkash_pay">
                                    <label class="bx_font_16_m" for="bkash_pay">bKash Payment</label>
                                    <div class="bx_check_out_payment_details">
                                        <h2 class="bx_book_check_out_headding">Your Payable Amount:
                                            <span
                                                class="bx_book_payable_amount font-weight-bold">{{ currency_type(Cart::getTotal()) }}</span>
                                        </h2>
                                        <h3 class="bx_book_check_sub_headding">How to Pay</h3>
                                        <ul class="pt-2">
                                            <li>"Place Order" এ ক্লিক করুন।</li>
                                            <li>bkash পেমেন্ট পেজ থেকে Marchent, Invoice no, Amount নিশ্চিত হোন।</li>
                                            <li>"Your bKash account number" এ আপনার বিকাশ নম্বর টি দিন "Proceed" এ ক্লিক
                                                করুন।</li>
                                            <li>আপনার মোবাইল এ আসা OTP কোড টি দিয়ে, "Proceed" এ ক্লিক করুন।</li>
                                            <li>এখন, আপনি একটি নিশ্চিতকরণ এসএমএস পাবেন।</li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            @error('method')
                            <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>
                            @enderror
                            <div class="bx_check_out_order_btn d-flex">
                                <button type="button" id="bx_book_checkout_btn" class="btn  bx_btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  pt-5 pt-md-0">
                        <div class="bx_check_out_content_right">
                            <div class="bx_check_out_right_heading">Billing Details</div>

                            <div class="bx_billing_details_form_fields d-flex flex-column">
                                <div class="form-group">
                                    <label class="bx_font_14_r bx_billing_details_label" for="full_name">Full
                                        Name *</label>
                                    <input type="text" name="full_name" id="full_name"
                                        class="bx_billing_details_field bx_font_13_r form-control @error('full_name') is-invalid @enderror "
                                        placeholder="Full Name"  value="{{ old('isbn', isset($order) ? $order->full_name : '') }}">
                                    @error('full_name')
                                    <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>
                                    @enderror
                                </div>

                                <!--<div class="form-group">-->
                                <!--    <label class="bx_font_14_r bx_billing_details_label" for="company_name">Company-->
                                <!--        Name</label>-->
                                <!--    <input type="text" name="company_name" id="company_name"-->
                                <!--        class="bx_billing_details_field bx_font_13_r form-control"-->
                                <!--        placeholder="Company name"  value="{{ old('isbn', isset($order) ? $order->company_name : '') }}">-->
                                <!--</div>-->


                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <!--        <div class="form-group">-->
                                <!--            <label class="bx_font_14_r bx_billing_details_label"-->
                                <!--                for="country_name">Country-->
                                <!--                *</label>-->
                                <!--            <input type="text" name="country_name" id="country_name"-->
                                <!--                class="bx_billing_details_field bx_font_13_r form-control @error('country_name') is-invalid @enderror "-->
                                <!--                placeholder="Country" value="Bangladesh" value="{{ old('isbn', isset($order) ? $order->country_name : '') }}">-->
                                <!--            @error('country_name')-->
                                <!--            <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>-->
                                <!--            @enderror-->
                                <!--        </div>-->
                                <!--    </div>-->
                                    <!--<div class="col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label class="bx_font_14_r bx_billing_details_label"-->
                                    <!--            for="post_code">Postcode/-->
                                    <!--            Zip *</label>-->
                                    <!--        <input type="text" name="post_code" id="post_code"-->
                                    <!--            class="bx_billing_details_field bx_font_13_r form-control @error('post_code') is-invalid @enderror "-->
                                    <!--            placeholder="Postcode/ Zip" value="{{ old('isbn', isset($order) ? $order->post_code : '') }}">-->
                                    <!--        @error('post_code')-->
                                    <!--        <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>-->
                                    <!--        @enderror-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <div class="form-group">
                                    @php
                                    $districts= App\Models\District::all();
                                    @endphp
                                    <label class="bx_font_14_r bx_billing_details_label" for="city_name">District
                                        *</label>
                                    <select
                                        class="form-control bx_billing_details_field  @error('city_name') is-invalid @enderror"
                                        id="city_name" name="city_name">
                                        <option value="">Default</option>
                                        @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_name')
                                    <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>
                                    @enderror
                                </div>
                                <div class="form-group" id="not_dhaka">
                                    <label class="bx_font_14_r bx_billing_details_label" for="address">Thana
                                        *</label>
                                    <select
                                        class="form-control bx_billing_details_field  @error('address') is-invalid @enderror"
                                        id="address" name="address">
                                        
                                    </select>
                                    @error('address')
                                    <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>
                                    @enderror
                                    <input type="text" name="address_two"
                                        class="bx_billing_details_field input_two bx_font_13_r form-control"
                                        placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label class="bx_font_14_r bx_billing_details_label" for="contact">Contact info
                                        *</label>
                                    <input type="text" name="phone" id="contact"
                                        class="bx_billing_details_field  bx_font_13_r form-control @error('phone') is-invalid @enderror"
                                        placeholder="Phone" value="{{ old('isbn', isset($order) ? $order->phone : '') }}">
                                    @error('phone')
                                    <span class="text-danger pt-1 d-inline-block">{{ $message  }}</span>
                                    @enderror
                                    <input type="text" name="email"
                                        class="bx_billing_details_field bx_font_13_r input_two form-control"
                                        placeholder="Email Adderss" value="{{ old('isbn', isset($order) ? $order->email : '') }}">

                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label class="bx_font_14_r bx_billing_details_label" for="order_notes">Order-->
                                <!--        Notes</label>-->
                                <!--    <textarea class="form-control bx_billing_details_field_textarea" name="order_notes"-->
                                <!--        id="order_notes" rows="3" placeholder="Order Notes"></textarea>-->
                                <!--</div>-->
                                {{-- <div class="form-check">
                                <label class="form-check-label bx_font_14_r">
                                    <input type="checkbox" class="form-check-input" name="create_account" id=""
                                        value="create">
                                    Create an account?
                                </label>
                            </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- end check out section -->

@endsection
@section('scripts')
<script>
    (function ($) {
        "use strict";
        $('.bx_check_out_payment_method input.bx_book_pay_type').on('change', function () {
            $(this).parent().siblings().removeClass('active');
            $(this).parent().siblings().find('.bx_check_out_payment_details').hide('fast');
            $(this).parent().addClass('active');
            $('input[name=method]:checked').siblings('.bx_check_out_payment_details').show('fast');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $This = $(this);
            $.ajax({
                type: 'POST',
                url: '/checkout/delivery/type',
                data: {
                    delivery_type: $(this).val(),
                },
                success: function (data) {
                    $('#bx_checkout_shipping_type').html(data.shipping);
                    $('.bx_book_checkout_total').html("Tk. " + data.total);
                    $('.bx_book_payable_amount').html("Tk. " + data.total);
                }
            });
        });
        $('#city_name').on('change', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $This = $(this),
             $id = $(this).val(),
             dhaka = $('#dhaka'),
             not_dhaka = $('#not_dhaka');
            $.ajax({
                type: 'POST',
                url: "/ajax-city/"+ $id,
                data: {
                    id: $id,
                },
                success: function (data) {
                    $('#not_dhaka #address').html(data.districts);
                }
            });
        });

        $('#bx_book_checkout_btn').on('click', function () {
            $('#bx_book_checkout_form').submit();
        });
    })(jQuery);

</script>
@endsection
