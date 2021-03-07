@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Update Sub Category</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.subcategories.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class=" form-group">
                                <label for="category_id" class=" form-control-label">Select Category</label>
                                <select name="category_id" id="category_id" data-placeholder="Choose a Category..."
                                    class="standardSelect form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                    tabindex="1">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{ ( old('category_id') || ($category->id == $subcategory->category_id)) ? 'selected' : ''}}>
                                        {{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" form-group">
                                <label for="title" class=" form-control-label">Name</label>
                                <input type="text" id="title"
                                    class="{{ $errors->has('title') ? 'is-invalid' : '' }} form-control" name="title"
                                    value="{{ old('title', isset($subcategory) ? $subcategory->title : '') }}">
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
