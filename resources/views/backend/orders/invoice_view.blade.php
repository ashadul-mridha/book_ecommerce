<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Express Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <style>
        .container {
            background: #fff;
            width: 720px;
            min-height: 1180px;
            margin: 0 auto;
            font: normal 13px/1.4em "Open Sans", Sans-serif;
        }

        .f_left {
            float: left;
        }

        .f_right {
            float: right;
        }

        .clear_fix {
            display: block;
            clear: both;
        }

        .m_top_10 {
            margin-top: 10px;
        }

        .m_top_20 {
            margin-top: 20px;
        }

        .m_top_30 {
            margin-top: 30px;
        }


        .m_right_30 {
            margin-right: 30px;
        }

        .text_blod {
            font-weight: 600;
        }

        .font_size_16 {
            font-size: 16px;
        }

        .font_size_20 {
            font-size: 20px;
        }

        .text_left {
            text-align-last: left;
        }

        .text_right {
            text-align: right;
        }

        .invoice_top {
            margin-bottom: 50px;
        }

        .invoice_top .company_name {
            color: #0100a4;
            font-weight: bold;
            font-size: 32px;
        }



        .invoice_top .logo img {
            width: 150px;
            height: 40px;
        }

        .spacer {
            height: 15px;
            display: block;
        }

        .invoice_info tr td {
            min-width: 100px;
            min-height: 18px;
            margin-bottom: 3px;
            font-size: 14px;
        }

        .invoice_title_number {
            margin-top: 50px;
            display: inline-block;
        }

        .invoice_title_number .title {
            margin-right: 5px;
            text-align: right;
            font-size: 35px;
        }

        .invoice_title_number .number {
            margin-left: 5px;
            text-align: left;
            font-size: 20px;
        }

        .client_info>div {
            margin-bottom: 3px;
        }

        .client_info span {
            display: block;
        }

        .client_info>span {
            margin-bottom: 3px;
        }

        .items {
            margin: 50px 40px 40px 40px;
        }

        .items table {
            border-collapse: separate;
            width: 100%;
        }

        .items .first-cell,
        .items table th:first-child,
        .items table td:first-child {
            width: 18px;
            text-align: right;
        }

        .items table {
            border-collapse: separate;
            width: 100%;
        }

        .items table th {
            font-weight: bold;
            padding: 12px 10px;
            text-align: right;
            border-bottom: 1px solid #444;
            text-transform: uppercase;
        }

        .items table th:nth-child(2) {
            text-align: left;
        }

        .items table .w_300 {
            width: 300px;
        }

        .items table th:last-child {
            text-align: right;
        }

        .items table td {
            border-right: 1px solid #b6b6b6;
            padding: 15px 10px;
            text-align: right;
        }

        .items table td:first-child {
            text-align: left;
            border-right: none !important;
        }

        .items table td:nth-child(2) {
            text-align: left;
        }

        .items table td:last-child {
            border-right: none !important;
        }

        .sums {
            margin: 0px 40px 40px 0px;
            position: relative;
        }

        .sums::after {
            content: "";
            display: block;
            width: 100%;
            clear: both;

        }

        .sums table tr th,
        .sums table tr td {
            min-width: 100px;
            padding: 10px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }

        .sums table tr th {
            text-align: left;
            padding-right: 25px;
            color: #707070;
        }

        .sums table tr.amount_total td:last-child:before {
            display: block;
            content: "";
            border-top: 1px solid #444;
            position: absolute;
            top: 0;
            left: -555px;
            right: -10px;
        }

        .sums .total {
            position: relative;
        }

        .terms {
            margin: 250px 0 15px 0;
            display: block;
        }

        .terms>div {
            min-height: 70px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="invoice_top">
            <div class="logo f_left">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIsAAAAkCAYAAAC5U8nEAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUMzNkE5RDE4NkNDMTFFQTg0NDlGNEE0RTVFODhENEEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUMzNkE5RDI4NkNDMTFFQTg0NDlGNEE0RTVFODhENEEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBQzM2QTlDRjg2Q0MxMUVBODQ0OUY0QTRFNUU4OEQ0QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBQzM2QTlEMDg2Q0MxMUVBODQ0OUY0QTRFNUU4OEQ0QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PicRISYAAApUSURBVHja7FsLlFVV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"
                    alt="logo">
            </div>
            <div class="conpany_info f_right ">
                <table>
                    <tr>
                        <td class="text_right"><span class="company_name">Book Express</span></td>
                    </tr>
                    <tr>
                        <td class="text_right">Dhaka</td>
                    </tr>
                    <tr>
                        <td class="text_right">Dhaka, Dhaka, BD</td>
                    </tr>
                    <tr>
                        <td class="text_right">03213135215</td>
                    </tr>
                    <tr>
                        <td class="text_right">bookexpress@gmail.com</td>
                    </tr>
                </table>
            </div>
            <span class="clear_fix"></span>
        </div>
        <div class="m_top_10">

            <div class="invoice_info f_left">

                <table>
                    <tr>
                        <td>Issue Date:</td>
                        <td>{{ $order->created_at->format("m/d/Y") }} </td>

                    </tr>
                    <tr>
                        <td>Net:</td>
                        <td>
                            @if (!empty($order->created_at) && !empty($order->updated_at))
                            {{ $order->updated_at->diffInDays($order->created_at) }}
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <td>Due Date:</td>
                        <td>{{ $order->updated_at->format("m/d/Y") }} </td>
                    </tr>
                </table>
                <div class="invoice_title_number">

                    <span class="title">INVOICE:</span>
                    <span class="number">#{{ $order->id }}</span>

                </div>
            </div>
            <div class="client_info f_right m_right_30 text_left">
                <span class="text_blod">Bill To:</span>
                <div>
                    <span>{{ ucwords($order->billing_full_name)}}</span>
                </div>

                <div>
                    @if ($order->billing_address_two)
                    <span>{{ ucwords($order->billing_address_two)}}</span>
                    @endif
                    <span>{{ ucwords($order->billing_address)}}</span>
                </div>
                <div>
                    <span>{{ $order->billing_post_code}} {{ ucwords($order->billing_city)}}</span>
                </div>
                <div>
                    <span>{{ $order->billing_phone}}</span>
                </div>
                @if ($order->billing_email)
                <div>
                    <span>{{ $order->billing_email}}</span>
                </div>
                @endif
            </div>
            <div class="clear_fix"></div>
        </div>

        <div class="items">
            <table cellpadding="0" cellspacing="0">

                <tbody>
                    <tr>
                        <th></th>
                        <th class="w_300">Book Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    @php

                    $id = 1;
                    @endphp

                    @foreach ($order->books as $book)
                    <tr class="item">
                        <td>{{ $id}}.</td>
                        <td class="w_300">{{ $book->title}}</td>
                        <td>{{ $book->pivot->quantity}}</td>
                        <td>{{ currency_type( $book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price) }}
                        </td>
                        <td class="item_total">
                            {{ currency_type(($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price) *  $book->pivot->quantity)}}
                        </td>
                    </tr>
                    @php
                    $id++;
                    @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="sums f_right m_top_30">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <th>Subtotal:</th>
                        <td class="sub_total text_blod">{{ currency_type($order->billing_subtotal)}}</td>

                    </tr>

                    <tr data-iterate="tax">
                        <th>Shipping:</th>
                        <td class="shipping_free">{{ currency_type($order->billing_shipping)}}</td>

                    </tr>

                    <tr class="amount_total">
                        <th>Total:</th>
                        <td class="total">{{ currency_type($order->billing_total)}}</td>
                    </tr>

                    <tr>
                        <th>Paid:</th>
                        <td class="paid">
                            @if ($order->payment_gatway == 'cash_on_delivery')
                            {{ currency_type(0) }}
                            @else
                            @if ($order->payment_status != 0)
                            {{ currency_type($order->billing_total) }}
                            @else
                            {{ currency_type(0) }}
                            @endif
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <th>Amount Due:</th>
                        <td class="due">
                            @if ($order->payment_gatway == 'cash_on_delivery')
                            {{ currency_type($order->billing_total) }}
                            @else
                            @if ($order->payment_status == 1)
                            {{ currency_type(0) }}
                            @else
                            {{ currency_type($order->billing_total) }}
                            @endif
                            @endif

                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
        <div class="terms">
            <span class="">Fred, thank you very much. We really appreciate your business.</span>
            <div>
                Please send payments before the due date.</div>

        </div>

    </div>
</body>

</html>
