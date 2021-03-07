@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Category</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.categories.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class=" form-group">
                                <label for="title" class=" form-control-label">Name</label>
                                <input type="text" id="title"
                                    class="{{ $errors->has('title') ? 'is-invalid' : '' }} form-control" name="title"
                                    value="{{ old('title', isset($category) ? $category->title : '') }}">
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
