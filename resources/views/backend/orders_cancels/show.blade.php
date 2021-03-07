@extends('layouts.backend')

@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Order Cancel Details</strong>
                        <a class="btn btn-sm btn-success" href="{{ url('admin/cancels/orders') }}">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <h2 class="card-header">Id : {{$cancel_order->id}}
                                </h2>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Order Id :</strong>
                                        <span>{{ $cancel_order->order_id }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Reason : </strong>
                                        <span>{{ $cancel_order->reason }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Customer Phone : </strong>
                                        <span>{{ $cancel_order->phone }}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
