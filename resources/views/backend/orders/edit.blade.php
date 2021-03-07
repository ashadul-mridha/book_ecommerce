@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="{{asset('backend/assets/css/lib/chosen/chosen.min.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Book</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.orders.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_full_name" class=" form-control-label">Customer
                                                    Name</label>
                                                <input type="text" id="billing_full_name"
                                                    class="{{ $errors->has('billing_full_name') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_full_name"
                                                    value="{{ old('billing_full_name', isset($order) ? $order->billing_full_name : '') }}">
                                                @if ($errors->has('billing_full_name'))
                                                <span
                                                    class="text-danger">{{ $errors->first('billing_full_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_company" class=" form-control-label">Customer
                                                    Company
                                                    name</label>
                                                <input type="text" id="billing_company"
                                                    class="{{ $errors->has('billing_company') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_company"
                                                    value="{{ old('billing_company', isset($order) ? $order->billing_company : '') }}">
                                                @if ($errors->has('billing_company'))
                                                <span class="text-danger">{{ $errors->first('billing_company') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_phone" class=" form-control-label">Customer
                                                    Phone</label>
                                                <input type="text" id="billing_phone"
                                                    class="{{ $errors->has('billing_phone') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_phone"
                                                    value="{{ old('billing_phone', isset($order) ? $order->billing_phone : '') }}">
                                                @if ($errors->has('billing_phone'))
                                                <span class="text-danger">{{ $errors->first('billing_phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_email" class=" form-control-label">Customer
                                                    Email</label>
                                                <input type="text" id="billing_email"
                                                    class="{{ $errors->has('billing_email') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_email"
                                                    value="{{ old('billing_email', isset($order) ? $order->billing_email : '') }}">
                                                @if ($errors->has('billing_email'))
                                                <span class="text-danger">{{ $errors->first('billing_email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_country" class=" form-control-label">Customer
                                                    Country</label>
                                                <input type="text" id="billing_country"
                                                    class="{{ $errors->has('billing_country') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_country"
                                                    value="{{ old('billing_country', isset($order) ? $order->billing_country : '') }}">
                                                @if ($errors->has('billing_country'))
                                                <span class="text-danger">{{ $errors->first('billing_country') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" form-group">
                                                <label for="billing_city" class=" form-control-label">Customer
                                                    City</label>
                                                <input type="text" id="billing_city"
                                                    class="{{ $errors->has('billing_city') ? 'is-invalid' : '' }} form-control"
                                                    name="billing_city"
                                                    value="{{ old('billing_city', isset($order) ? $order->billing_city : '') }}">
                                                @if ($errors->has('billing_city'))
                                                <span class="text-danger">{{ $errors->first('billing_city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" form-group">
                                        <label for="billing_address" class=" form-control-label">Customer
                                            Address</label>
                                        <input type="text" id="billing_address"
                                            class="{{ $errors->has('billing_address') ? 'is-invalid' : '' }} form-control"
                                            name="billing_address"
                                            value="{{ old('billing_address', isset($order) ? $order->billing_address : '') }}">
                                        @if ($errors->has('billing_address_two'))
                                        <span class="text-danger">{{ $errors->first('billing_address_two') }}</span>
                                        @endif
                                        <input type="text" id="billing_address_two"
                                            class="{{ $errors->has('billing_address_two') ? 'is-invalid' : '' }} form-control mt-2"
                                            name="billing_address_two"
                                            value="{{ old('billing_address_two', isset($order) ? $order->billing_address_two : '') }}">
                                    </div>

                                    <div class=" form-group">
                                        <label for="billing_post_code" class=" form-control-label">Customer Post
                                            Code</label>
                                        <input type="text" id="billing_post_code"
                                            class="{{ $errors->has('billing_post_code') ? 'is-invalid' : '' }} form-control"
                                            name="billing_post_code"
                                            value="{{ old('billing_post_code', isset($order) ? $order->billing_post_code : '') }}">
                                        @if ($errors->has('billing_post_code'))
                                        <span class="text-danger">{{ $errors->first('billing_post_code') }}</span>
                                        @endif
                                    </div>

                                    <div class=" form-group">
                                        <label for="billing_order_note" class=" form-control-label">Customer Order
                                            Note</label>
                                        <textarea name="billing_order_note" id="billing_order_note" rows="4"
                                            placeholder="billing_order_note..."
                                            class="form-control">{{ old('billing_order_note', isset($order) ? $order->billing_order_note : '') }}</textarea>
                                        @if ($errors->has('billing_order_note'))
                                        <span class="text-danger">{{ $errors->first('billing_order_note') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="payment_gatway" class=" form-control-label">Payment Gatway</label>
                                        <select name="payment_gatway" id="payment_gatway"
                                            data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('payment_gatway') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            @foreach (order_payment_getway() as $payment)
                                            <option value="{{$payment}}"
                                                {{ ( old('payment_gatway') || ($payment == $order->payment_gatway)) ? 'selected' : ''}}>
                                                {{text_formate($payment)}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('payment_gatway'))
                                        <span class="text-danger">{{ $errors->first('payment_gatway') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="payment_status" class=" form-control-label">Payment Status</label>
                                        <select name="payment_status" id="payment_status"
                                            data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('payment_status') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            <option value="1"
                                                {{  (1 == $order->payment_status) ? 'selected' : ''}}>Paid</option>
                                            <option value="0"
                                                {{  (0 == $order->payment_status) ? 'selected' : ''}}>Due</option>
                                        </select>
                                        @if ($errors->has('order_status'))
                                        <span class="text-danger">{{ $errors->first('order_status') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="payment_trid" class=" form-control-label">Paymen TxId</label>
                                        <input type="text" id="payment_trid"
                                            class="{{ $errors->has('payment_trid') ? 'is-invalid' : '' }} form-control"
                                            name="payment_trid"
                                            value="{{ old('payment_trid', isset($order) ? $order->payment_trid : '') }}">
                                        @if ($errors->has('payment_trid'))
                                        <span class="text-danger">{{ $errors->first('payment_trid') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="order_status" class=" form-control-label">Order Status</label>
                                        <select name="order_status" id="order_status"
                                            data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('order_status') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            @foreach (order_status() as $status)
                                            <option value="{{$status}}"
                                                {{ ( old('order_status') || ($status == $order->order_status)) ? 'selected' : ''}}>
                                                {{text_formate($status)}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('order_status'))
                                        <span class="text-danger">{{ $errors->first('order_status') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
@section('scripts')
<script src="{{asset('backend/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>
@endsection
@section('scripts_custom')
<script>
    jQuery(document).ready(function () {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });

</script>
@endsection
