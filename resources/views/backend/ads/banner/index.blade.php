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
                        <strong class="card-title">All Banner Ads</strong>
                       
                        <a class="btn btn-sm btn-success" href="{{ route('admin.adsbanner.create') }}">Add
                            Banner Ads</a>
                        
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Image Two</th>
                                    <th>Link Two</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach($ads_all as $key => $ads)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td><img src="{{asset('images/ads/banner'). '/'.$ads->image}}" alt="Logo"
                                            width="250px">
                                    </td>
                                    <td>{{ $ads->link }}</td>
                                    <td><img src="{{asset('images/ads/banner'). '/'.$ads->image_two}}" alt="Logo"
                                            width="250px">
                                    </td>
                                    <td>{{ $ads->link_two }}</td>
                                    <td>
                                        @if ($ads->status == 1)
                                        <span class="badge badge-info">Publish</span>
                                        @else
                                        <span class="badge badge-danger">Unpublish</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.adsbanner.edit', $ads->id) }}">
                                            Edit
                                        </a>
                                        @if ($ads_all->count() > 1)
                                        <form action="{{ route('admin.adsbanner.destroy', $ads->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" onclick="return confirm('Are you sure?')">
                                        </form>
                                        @endif
                                       
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
