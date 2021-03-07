@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="{{asset('backend/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection
@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Order Details</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.orders.index') }}">Back</a>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-7">
                                <h2 class="card-header"><strong class="text-bold">Order Id: </strong>{{$order->id}}</h2>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">User Id </strong>
                                        <span>{{ $order->user_id }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Name : </strong>
                                        <span>{{ $order->billing_full_name }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Company name : </strong>
                                        <span>{{ $order->billing_company }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Phone : </strong>
                                        <span>{{ $order->billing_phone}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Email : </strong>
                                        <span>{{ $order->billing_email }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Country : </strong>
                                        <span>{{ $order->billing_country }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer District : </strong>
                                        <span>{{ $order->billing_city }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Thana : </strong>
                                        <span>{{ $order->billing_address }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Address : </strong>
                                        <span>{{ $order->billing_address_two }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Post Code : </strong>
                                        <span>{{ $order->billing_post_code }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Order Notes : </strong>
                                        <span>{{ $order->billing_order_note }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Payment : </strong>
                                        <span>{{ text_formate($order->payment_gatway) }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Payment Status :</strong>
                                        @if ($order->payment_status == 1)
                                        <span class="badge badge-info">Paid</span>
                                        @else
                                        <span class="badge badge-danger">Due</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Payment TXID: </strong>
                                        <span>{{ $order->payment_trid }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Discount: </strong>
                                        <span>{{ currency_type($order->billing_discount) }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Subtotal: </strong>
                                        <span>{{ currency_type($order->billing_subtotal) }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Shipping Free: </strong>
                                        <span>{{ currency_type($order->billing_shipping) }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Total: </strong>
                                        <span>{{ currency_type($order->billing_total) }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Order Status </strong>
                                        <span>{{ text_formate($order->order_status) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <strong class="card-title">Order Books</strong>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($order->books as $book)
                                            <li class="list-group-item">
                                                <span class="d-block">
                                                    <strong class="text-bold mr-4">Book Name: </strong>
                                                    <span>{{ $book->title }}</span>
                                                </span>
                                                <span class="d-block">
                                                    <strong class="text-bold mr-4">Book Quantity: </strong>
                                                    <span>{{ $book->pivot->quantity }}</span>
                                                </span>
                                                <span class="d-block">
                                                    <strong class="text-bold mr-4">Book Photo: </strong>
                                                    <img width="80" src="{{ asset('images/book/'.$book->photo) }}" alt="Book">
                                                </span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
@section('scripts')
<script src="{{asset('backend/assets/js/lib/data-table/datatables.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/jszip.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
<script src="{{asset('backend/assets/js/init/datatables-init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('scripts_custom')
<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
@endsection
