@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Footer 1st Cloumn</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.first.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.first.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="logo" class=" form-control-label">Logo</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="logo" name="logo"
                                        class="form-control-file {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('logo'))
                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="description" class=" form-control-label">Description</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="description" id="description" rows="2" placeholder="Content..."
                                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">
                                    {{ old('description', isset($footer) ? $footer->description : '') }}
                                </textarea>
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row  form-group social_clone">
                                <div class="col col-md-3 align-self-center">
                                    <label for="social_icon" class=" form-control-label">Social Icon</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    Icon Class Name: <input type="text" id="social_icon"
                                        class="{{ $errors->has('social_icon.*') ? 'is-invalid' : '' }} form-control mb-2"
                                        name="social_icon[]"
                                        >
                                        @if ($errors->has('social_icon.*'))
                                        <span class="text-danger d-block">{{ $errors->first('social_icon.*') }}</span>
                                        @endif
                                        Icon Link: <input type="text" id="social_icon"
                                        class="{{ $errors->has('social_link.*') ? 'is-invalid' : '' }} form-control"
                                        name="social_link[]"
                                        >
                                    @if ($errors->has('social_link.*'))
                                    <span class="text-danger d-block">{{ $errors->first('social_link.*') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9 offset-md-3">
                                    <button type="button" id="social_add" class="btn btn-info btn-sm mt-2">Add New</button>
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
@section('scripts_custom')
<script type="text/javascript">
    (function ($) {
    "use strict";
    $(document).on('click', '#social_add', function() {
        $('.social_clone:first').clone().insertAfter(".social_clone:last").find('.col-md-9').append('<button type="button" class=" social_delete btn btn-danger btn-sm mt-2">Delete</button>');
    }).on('click', '.social_delete', function() {
        $(this).closest('.social_clone').remove();
    });

})(jQuery);
</script>
@endsection
