@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Ads</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.adsbanner.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.adsbanner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="image" class=" form-control-label">Image</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="image" name="image"
                                        class="form-control-file {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="link" class=" form-control-label">Link</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="link" name="link"
                                        class="form-control-file {{ $errors->has('link') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('link'))
                                    <span class="text-danger">{{ $errors->first('link') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="image_two" class=" form-control-label">Image Two</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="image_two" name="image_two"
                                        class="form-control-file {{ $errors->has('image_two') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('image_two'))
                                    <span class="text-danger">{{ $errors->first('image_two') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="link_two" class=" form-control-label">Link Two</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="link_two" name="link_two"
                                        class="form-control-file {{ $errors->has('link_two') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('link_two'))
                                    <span class="text-danger">{{ $errors->first('link_two') }}</span>
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
                                                    class="form-check-input">Publish
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
