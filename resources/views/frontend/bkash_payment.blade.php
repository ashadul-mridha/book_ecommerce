@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/cash_on.css') }}">
@endsection
@section('content')

<section class="bx_book_order_submit_page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="bx_book_order_content text-center">
                    <div class="bx_book_order_message text-success">
                        আপনার অর্ডারটি গ্রহণ করা হয়েছে। আমাদের সাথে থাকার জন্য ধন্যবাদ।
                        অনুগ্রহ করে {{ $order->billing_total }} টাকা এখানে বিকাশে পেমেন্ট করুন ।
                        <p class="text-left pt-1">1. ডায়েল= *২৪৭#</p>
                        <p class="text-left pt-1">2. সিলেক্ট অপশান = ৪ (Payment)</p>
                        <p class="text-left pt-1">3. পেম্যান্ট নাম্বার = ০১৯০৩৯৪৮৪৯৪</p>
                        <p class="text-left pt-1">4. টাকা পরিমান = {{ $order->billing_total }}</p>
                        <p class="text-left pt-1">5. রেফারেন = {{ $order->id }} </p>
                        <p class="text-left pt-1">6. কাউন্টার নাম্বার = ১ </p>
                        <p class="text-left pt-1">7. বিকাশ পিন = XXXX</p>
                        আপনার অর্ডার আইডি: {{ $order->id }}
                    </div>
                    <div class="bx_book_order_track_text">
                        <p>To Track Your Order, Please <a href="{{ route('user.orders').'?id='.$order->id }}">Click
                                Here</a></p>
                    </div>
                    {{-- <button id="bKash_button" class="btn payment-btn">Pay With bKash</button> --}}

                    <div class="bx_book_order_home_button">
                        <a href="{{ url('/') }}" class="bx_book_home_btn"> Go to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')


<script>
    // $(function () {
    //     $.getScript("https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js")
    //         .done(function (script) {
    //             var pageContext = '',
    //                 CSRF = '{{ csrf_token() }}';

    //             var custOrderId = "{{ $order->id }}";
    //             var paymentID;

    //             bKash.init({
    //                 paymentMode: 'checkout',
    //                 paymentRequest: {
    //                     amount: "{{ $order -> billing_total }}",
    //                     intent: 'sale'
    //                 },

    //                 createRequest: function (request) {
    //                     $.ajax({
    //                         url: '/payment/createbkashpayment',
    //                         type: 'POST',
    //                         data: 'custorderid=' + custOrderId + '&_tk=' + CSRF +
    //                             'amount=' + "{{ $order -> billing_total }}",

    //                         success: function (data) {
    //                             if (data && data.paymentID != null) {
    //                                 paymentID = data.paymentID;
    //                                 bKash.create().onSuccess(data);

    //                             } else {
    //                                 bKash.create().onError(); //run clean up code
    //                             }
    //                         },
    //                         error: function () {
    //                             bKash.create().onError(); //run clean up code
    //                         }
    //                     });
    //                 },

    //                 executeRequestOnAuthorization: function () {
    //                     $.ajax({
    //                         url: '/payment/executebkashpayment',
    //                         type: 'POST',
    //                         data: 'paymentID=' + paymentID + '&_tk=' + CSRF,

    //                         success: function (data) {
    //                             window.location.href =
    //                                 '/bkashconfirmorder?custorderId=' +
    //                                 custOrderId + '&paymentID=' + paymentID +
    //                                 "&error=" + data.errorMessage;
    //                         },
    //                         error: function () {
    //                             bKash.execute().onError(); //run clean up code
    //                         }
    //                     });
    //                 },

    //                 onClose: function () {
    //                     //define what happens if the user closes the pop up window

    //                     //your code goes here
    //                 }

    //             });

    //             $('#bKash_button').removeAttr('disabled');
    //             $('#bKash_button').trigger('click');

    //         });
    // });
    

</script>


@endsection
