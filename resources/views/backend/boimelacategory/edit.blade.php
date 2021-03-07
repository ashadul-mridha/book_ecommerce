@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Update Boimela Category</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.categoryboimela.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.categoryboimela.update', $boimelacat->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="category_id" class=" form-control-label">Select
                                        Category</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class=" form-group">
                                        <select name="category_id" id="category_id"
                                            data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}"
                                                {{ ( old('category_id') || ($category->id == $boimelacat->category_id)) ? 'selected' : ''}}>
                                                {{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label class=" form-control-label">Status</label></div>
                                <div class="col col-md-9">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="status" class="form-check-label ">
                                                <input type="checkbox" id="status" name="status" value="on"
                                                    class="form-check-input"
                                                    {{ $boimelacat->status == 1 ? 'checked':''}}>Publish
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
