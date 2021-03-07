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
                @if(session()->get('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session()->get('success') }} </strong>
                </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">All Orders</strong>
                        {{-- @can('manage-order')
                        <a class="btn btn-sm btn-success" href="{{ route('admin.orders.create') }}">Add
                        Book</a>
                        @endcan --}}
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 14px">
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Payment Gatway</th>
                                    <th>Subtotal</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $key => $order)
                                <tr
                                    class="
                                    @if ($order->order_status =='CANCELLED')
                                     text-danger
                                    @endif
                                    @if ($order->order_status =='COMPLETED')
                                        text-success
                                    @endif">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->billing_full_name }}</td>
                                    <td>{{ $order->billing_phone }}</td>
                                    <td>{{ text_formate($order->payment_gatway) }}</td>
                                    <td>{{ $order->billing_subtotal }}</td>
                                    <td>{{ $order->billing_shipping }}</td>
                                    <td>{{ $order->billing_total }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td width="22%">
                                        @can('manage-order')
                                        <a class="btn btn-sm btn-primary mt-2"
                                            href="{{ route('admin.orders.show', $order->id) }}">
                                            Show
                                        </a>
                                        <a class="btn btn-sm btn-info mt-2"
                                            href="{{ route('admin.orders.edit', $order->id) }}">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger  mt-2" value="Delete"
                                                onclick="return confirm('Are you sure?')">
                                        </form>
                                        @if ($order->order_status != 'CANCELLED') 
                                        <a class="btn btn-sm btn-success mt-2"
                                            href="{{ route('admin.invoice.view', $order->id) }}">
                                            Invoice
                                        </a>
                                        <a class="btn btn-sm btn-warning mt-2"
                                            href="{{ route('admin.invoice.pdf', $order->id) }}">
                                            PDF
                                        </a>
                                        @endif
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
