@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/cash_on.css') }}">
@endsection
@section('content')

<section class="bx_book_order_submit_page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="bx_book_order_content text-center">
                    <div class="bx_book_order_message text-success">
                        @if ($order->payment_gatway == "rocket_pay")
                        আপনার অর্ডারটি গ্রহণ করা হয়েছে। আমাদের সাথে থাকার জন্য ধন্যবাদ।
                        অনুগ্রহ করে {{ $order->billing_total }} টাকা আমাদের বিলার আইডি XXX তে পেমেন্ট করুন।
                        যেকোন সাহায্যের জন্য আমাদের কাস্টমার কেয়ার XXX নম্বরে যোগাযোগ করুন।
                        আপনার অর্ডার আইডি: {{ $order->id }}
                        @endif
                        @if ($order->payment_gatway == "cash_on_delivery")
                        আপনার অর্ডারটি গ্রহণ করা হয়েছে। আমাদের সাথে থাকার জন্য ধন্যবাদ।
                        যেকোন সাহায্যের জন্য আমাদের কাস্টমার কেয়ার XXX নম্বরে যোগাযোগ করুন।
                        আপনার অর্ডার আইডি: {{ $order->id }}
                        @endif

                    </div>
                    <div class="bx_book_order_track_text">
                        <p>To Track Your Order, Please <a href="{{ route('user.orders').'?id='.$order->id }}">Click
                                Here</a></p>
                    </div>
                    <div class="bx_book_order_home_button">
                        <a href="{{ url('/') }}" class="bx_book_home_btn"> Go to homepage</a>
                    </div>
                </div>

                {{-- <div>
                    <button id="bKash_button" class="btn payment-btn">Pay With bKash</button>
                    <div id="bKashFrameWrapper"><iframe id="bKash-iFrame-81" frameborder="0" src="https://client.pay.bka.sh/checkout/2" name="bKash_checkout_app" ></iframe></div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection
