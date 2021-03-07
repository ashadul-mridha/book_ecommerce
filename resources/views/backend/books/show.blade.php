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
                        <strong class="card-title">Books Details</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.books.index') }}">Back</a>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <h2 class="card-header"><strong class="text-bold">Name: </strong>{{$book->title}}</h2>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">ISBN No. </strong>
                                        <span>{{ $book->isbn }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Author Name : </strong>
                                        <span>{{ $book->author->name }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Publisher name : </strong>
                                        @if ($book->publisher_id)
                                        <span>{{ $book->publisher->name }}</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">User Name : </strong>
                                        <span>{{ $book->user->name }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Price : </strong>
                                        <span>{{ $book->price }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Discount : </strong>
                                        <span>{{ $book->discount }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Description : </strong>
                                        <span>{{ $book->description }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Quantity : </strong>
                                        <span>{{ $book->quantity }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Edition : </strong>
                                        <span>{{ $book->edition }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Language : </strong>
                                        <span>{{ $book->language }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Status : </strong>
                                        @if ($book->status == 1)
                                        <span class="badge badge-info">Publish</span>
                                        @else
                                        <span class="badge badge-danger">Unpublish</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-bold mr-4">Best Seller :</strong>
                                        @if ($book->best_sale == 1)
                                        <span class="badge badge-info">Yes</span>
                                        @else
                                        <span class="badge badge-danger">No</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="{{ asset('images/book/'.$book->photo) }}" alt="Book">
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
    $(document).ready(function () {
        $('#bootstrap-data-table-export').DataTable();
    });

</script>
@endsection
