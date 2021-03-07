@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Banner</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.login-pages.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.login-pages.update', $banner->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="image" class=" form-control-label">Image</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="image" name="image"
                                        class="form-control-file {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    <img class="pt-3" width="200px"
                                        src="{{asset('images/login/' . $banner->image)}}" alt="logo">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
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
                                                    {{ $banner->status == 1 ? 'checked':''}}>Publish
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
