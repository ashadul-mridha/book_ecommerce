@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Update Author</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.authors.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class=" form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" id="name"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }} form-control" name="name"
                                    value="{{ old('name', isset($author) ? $author->name : '') }}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="description" class=" form-control-label">Description</label>
                                <textarea name="description" id="description" rows="4" placeholder="Content..."
                                    class="form-control">
                                            {{ old('description', isset($author) ? $author->description : '') }}</textarea>
                                @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif

                            </div>
                            <div class=" form-group ">
                                <label for="photo" class=" form-control-label">Photo</label>
                                <input type="file" id="photo" name="photo"
                                    class="form-control-file {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                                    <img src="{{asset('images/author/'.$author->photo)}}" alt="Autor Photo"
                                            width="50px">
                                @if ($errors->has('photo'))
                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-info btn-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
