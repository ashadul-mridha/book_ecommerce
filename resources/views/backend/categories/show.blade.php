@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Show Category</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.categories.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <h2 class="card-header"><strong>Name : </strong>{{$category->title}}</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Subcategory List</strong></li>
                            @php
                            $n = 1;
                            @endphp
                            @foreach ($category->subcategory as $item)
                            <li class="list-group-item">
                                {{ $n }} : {{ $item->title }}
                            </li>
                            @php
                            $n++;
                            @endphp
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
