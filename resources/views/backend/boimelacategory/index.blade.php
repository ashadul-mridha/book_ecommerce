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
                    @if(auth()->user()->can('manage-boimela-categories') || auth()->user()->can('manage-boimela'))
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Your Boimela Category</strong>
                       
                        @if ($boimelacategory->count() <= 0)
                            <a class="btn btn-sm btn-success" href="{{ route('admin.categoryboimela.create') }}">Boimela Category</a>
                        @endif
                        
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach($boimelacategory as $key => $boimelacat)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>
                                        {{ $boimelacat->category->title }}
                                    </td>
                                    <td>
                                        @if ($boimelacat->status == 1)
                                        <span class="badge badge-info">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.categoryboimela.edit', $boimelacat->id) }}">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.categoryboimela.destroy', $boimelacat->id) }}" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
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
                    @else
                    <p class="text-danger"> You do not have proper permission </p>
                    @endif
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

