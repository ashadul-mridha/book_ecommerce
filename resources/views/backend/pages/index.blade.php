@extends('layouts.backend')

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
                        <strong class="card-title">All Pages</strong>
                       
                        <a class="btn btn-sm btn-success" href="{{ route('admin.pages.create') }}">Add
                            Page</a>
                        
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach($pages as $key => $page)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>
                                        {{ $page->title }}
                                    </td>
                                    <td>{{ $page->slug }}</td>
                                    <td>
                                        {!!  substr($page->content, 0, 50) !!}
                                    </td>
                                    
                                    <td>
                                        @if ($page->status == 1)
                                        <span class="badge badge-info">Publish</span>
                                        @else
                                        <span class="badge badge-danger">Unpublish</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.pages.edit', $page->id) }}">
                                            Edit
                                        </a>
                                       
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" onclick="return confirm('Are you sure?')">
                                        </form>
                                      
                                       
                                    </td>
                                </tr>
                                @php
                                $id++;
                                @endphp
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
