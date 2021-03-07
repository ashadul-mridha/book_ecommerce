@extends('layouts.backend')

{{-- @section('styles')
<link rel="stylesheet" href="{{asset('backend/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection --}}
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
                    @if(auth()->user()->can('can-see-footers') || auth()->user()->can('manage-footers'))
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Foote Fourth Cloumn Data</strong>
                        @can('manage-footers')
                        @if (count($footers) <= 0) <a class="btn btn-sm btn-success"
                            href="{{ route('admin.fourth.create') }}">Add
                            Fourth Cloumn</a>
                            @endif
                            @endcan
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Heading</th>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach($footers as $key => $footer)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>{{ $footer->title }}</td>
                                    <td>
                                        @php
                                        $name = explode('|', $footer->name);

                                        @endphp
                                        <ul class="list-unstyled">
                                            @foreach ($name as $item)
                                            <li>{{ $item }}</li>

                                            @endforeach
                                    </td>
                                    <td>
                                        @php
                                        $link = explode('|', $footer->link);

                                        @endphp
                                        <ul class="list-unstyled">
                                            @foreach ($link as $item)
                                            <li>{{ $item }}</li>

                                            @endforeach
                                    </td>
                                    <td>

                                        @can('manage-footers')
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.fourth.edit', $footer->id) }}">
                                            Edit
                                        </a>
                                        @if (count($footers) > 1)
                                        <form action="{{ route('admin.fourth.destroy', $footer->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" onclick="return confirm('Are you sure?')">
                                        </form>
                                        @endif
                                        @endcan
                                    </td>
                                </tr>
                                @php
                                $id++;
                                @endphp
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
{{-- @section('scripts')
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
@endsection
@section('scripts_custom')
<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
@endsection --}}