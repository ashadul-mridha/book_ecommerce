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

                    @if(auth()->user()->can('manage-books'))
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">All Books</strong>
                       
                        <a class="btn btn-sm btn-success" href="{{ route('admin.books.create') }}">Add
                            Book</a>
                       
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ISBN No.</th>
                                    <th>Book</th>
                                    <th>Price</th>
                                    <th>Stock In</th>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Best Sale</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($books as $key => $book)
                                <tr>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{\Illuminate\Support\Str::limit($book->title, $limit = 20, $end = '...') }}
                                    </td>
                                    <td>{{ $book->price }}</td>
                                    <td class="{{ $book->quantity <=5 ? 'text-danger' : '' }}" >{{ $book->quantity }}</td>
                                    <td>{{ $book->author->name }}</td>
                                    <td><img src="{{asset('images/book/'.$book->photo)}}" alt="Logo" width="50px">
                                    </td>
                                    <td>
                                        @if ($book->status == 1)
                                        <span class="badge badge-info">Publish</span>
                                        @else
                                        <span class="badge badge-danger">Unpublish</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($book->best_sale == 1)
                                        <span class="badge badge-info">Yes</span>
                                        @else
                                        <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td width="22%">
                                       
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.books.show', $book->id) }}">
                                            Show
                                        </a>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.books.edit', $book->id) }}">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" onclick="return confirm('Are you sure?')">
                                        </form>
                                       
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-danger"> You do not have proper permission </p>
                    @endif
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
