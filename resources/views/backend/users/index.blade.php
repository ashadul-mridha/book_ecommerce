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

                @if(session()->get('errors'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session()->get('errors') }} </strong>
                </div>
                @endif
                <div class="card">
                    @if(auth()->user()->can('can-see-users') || auth()->user()->can('manage-users'))
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">All Users Data</strong>
                        @can('manage-users')
                        <a class="btn btn-sm btn-success" href="{{ route('admin.users.create') }}">Add
                            User</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles()->pluck('name') as $role)
                                        <span class="badge badge-info pl-1">{{ $role }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('manage-users')
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.users.edit', $user->id) }}">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete"
                                                {{ (count($user->getRoleNames()) ==1) && ($user->hasRole("super-admin")) ? "disabled" : "" }} onclick="return confirm('Are you sure?')">
                                        </form>

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
@endsection
@section('scripts_custom')
<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
@endsection
